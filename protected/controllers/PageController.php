<?php

class PageController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$model = $this->loadModelUrl();

		$model->view_count++;
		$model->save();

		$same_page = Page::model()->findAll(array(
			'condition' => "id <> {$model->id}"
		));
		shuffle($same_page);
		array_splice($same_page, 5);

		$this->pageTitle = $model->title;
		$this->meta_k = $model->keywords;
		$this->meta_d = $model->description;

		$this->render('view',array(
			'model' => $model,
			'same_page' => $same_page,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Page;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			// $model->city_id = $this->city->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/init.js');

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			// $model->city_id = $this->city->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/init.js');

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$sort = new CSort('Page');
		$sort->defaultOrder = 'date_create DESC';
		$sort->applyOrder($criteria);
		$count = Page::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$page_list = Page::model()->findAll($criteria);

		$page_top = Page::model()->findAll(array(
			'order' => 'view_count DESC',
			'limit' => 5,
		));

		$this->pageTitle = "Полезная информация о пластиковых окнах | Уход за окнами и подготовка к зиме";
		$this->meta_k = "пластиковые окна, ремонт окон, уход за окнами, подготовка окон к зиме, полезная информация";
		$this->meta_d = "Статьи о том, как продлить срок службы пластиковых окон, какие профилактическиие действия нужно предпринимать для сохраности окон и важные советы по эксплуатации.";

		if ($_GET['page'])
		{
			switch ($_GET['page'])
			{
				case 2:
					$this->pageTitle = "Статьи о правилах ухода за пластиковыми и деревянными окнами";
					$this->meta_k = "пластиковое окно, уход, чистота окон, статья, правило, долгостойкость";
					$this->meta_d = "Описание основных правил по уходу за окнами в разные сезоны года.";
					break;

				case 3: 
					$this->pageTitle = "Ошибки в эксплуатации оконных конструкций";
					$this->meta_k = "ошибка использования, ошибка профилактики, последствия, отсутствие уборки, пластиковое окно";
					$this->meta_d = "Основные ошибки в эксплуатации пластиковых окон и их последствия.";
					break;

				default:
					$this->pageTitle = $this->pageTitle.' | Страница '.$_GET['page'];
					$this->meta_k = $this->meta_k.', страница '.$_GET['page'];
					$this->meta_d = $this->meta_d.' Вы находитесь на странице '.$_GET['page'].'.';
					break;
			}
		}

		$this->render('index',array(
			'page_list' => $page_list,
			'page_top' => $page_top,
			'pages' => $pages,
			'count' => $count
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Page('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Page']))
			$model->attributes=$_GET['Page'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Page the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']))
			$model=Page::model()->find('url=:url', array(':url'=>$_GET['url']));
		if(isset($_GET['id']))
			$model=Page::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Page $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
