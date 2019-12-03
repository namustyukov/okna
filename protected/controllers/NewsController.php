<?php

class NewsController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->city_id = $this->city->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

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

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->city_id = $this->city->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

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
		if ($_GET['page'] > 5)
		{
			$param = str_replace($_GET['page'], 5, $_SERVER['REQUEST_URI']);
			header("HTTP/1.1 301 Moved Permanently");
			header ("Location: https://".$_SERVER['HTTP_HOST'].$param);
			die();
		}
		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$sort = new CSort('News');
		$sort->defaultOrder = 'date_create DESC';
		$sort->applyOrder($criteria);
		$count = News::model()->count($criteria);
		if ($count > 50)
			$count = 50;
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$news = News::model()->findAll($criteria);

		$companies_order = News::getCompanyOrder();

		$this->pageTitle = "Новости от производителей пластиковых окон в {$this->city->gorode}".($_GET['page'] > 1 ? ' | Страница '.$_GET['page'] : '');
		$this->meta_k = "новости в {$this->city->gorode}, фирмы {$this->city->goroda}, новые акции, контактные данные, актуальный адрес, официальный сайт".($_GET['page'] > 1 ? ', страница '.$_GET['page'] : '');
		$this->meta_d = "Новости о фирмах {$this->city->goroda} помогут отследить появление новых акций, получить актуальные контактные данные компаний, наблюдать за динамикой цен на окна.".($_GET['page'] > 1 ? ' | Страница '.$_GET['page'] : '');

		$this->render('index',array(
			'news' => $news,
			'pages' => $pages,
			'count' => $count,
			'companies_order' => $companies_order,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
