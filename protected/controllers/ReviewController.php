<?php

class ReviewController extends Controller
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
				'actions'=>array('index','view', 'ajaxcreate'),
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

	public function actionAjaxcreate()
	{
		$name = $_POST['name'];
		$company = $_POST['company'];
		$mark = $_POST['mark'];
		$message = $_POST['message'];
		$model = new Review;
		$model->text = $message;
		$model->name = $name;
		$model->mark = $mark;
		$model->company_id = $company;
		$model->city_id = $this->city->id;

		$data = array();
		if ($model->save())
		{
			$review = Review::model()->findByPk($model->id);
			$date = explode(".",date('d.m.Y', $review->add_time));
			switch ($date[1]){
				case 1: $m='января'; break;
				case 2: $m='февраля'; break;
				case 3: $m='марта'; break;
				case 4: $m='апреля'; break;
				case 5: $m='мая'; break;
				case 6: $m='июня'; break;
				case 7: $m='июля'; break;
				case 8: $m='августа'; break;
				case 9: $m='сентября'; break;
				case 10: $m='октября'; break;
				case 11: $m='ноября'; break;
				case 12: $m='декабря'; break;
			};
			$html = '<div class="content_review_item '.($review->mark == 1 ? '__good' : ($review->mark == -1 ? '__bad' : '')).'">
						<div class="content_review_item_header">
							<span>'.$review->name.'</span> | '.$date[0]*1.0.' '.$m.' '.$date[2].' | отзыв о фирме <span><a href="/'.$this->city->simbol_name.'/company/'.$review->company->url.'">'.$review->company->name.'</a></span>
						</div>
						<div class="content_review_item_content">
							<p>'.$review->text.'</p>
						</div>
					</div>';
			$data['html'] = $html;
			$data['id'] = $review->id;
		}
		else
			$data['error'] = 'error';

		echo CJSON::encode($data);
		Yii::app()->end();
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
		$model=new Review;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Review']))
		{
			$model->attributes=$_POST['Review'];
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

		if(isset($_POST['Review']))
		{
			$model->attributes=$_POST['Review'];
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
		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$criteria->order = "name ASC";
		$companies = Company::model()->findAll($criteria);

		$companies_order = Review::getCompanyOrder();

		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$sort = new CSort('Review');
		$sort->defaultOrder = 'add_time DESC';
		$sort->applyOrder($criteria);
		$count = Review::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
		$reviewes = Review::model()->findAll($criteria);

		$this->pageTitle = "Отзывы на пластиковые окна в {$this->city->gorode} | Жалобы, недовольства и советы покупателей";
		$this->meta_k = "отзывы клиентов {$this->city->goroda}, жалобы покупателей {$this->city->goroda}, окно в {$this->city->gorode}, советы в {$this->city->gorode}, где заказать в {$this->city->gorode}, плохая компания {$this->city->goroda}";
		$this->meta_d = "Отзывы о фирмах по продаже, монтажу и установке пластиковых окон в {$this->city->gorode}.";

		$this->render('index',array(
			'companies' => $companies,
			'companies_order' => $companies_order,
			'reviewes' => $reviewes,
			'pages' => $pages,
			'count' => $count,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Review('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Review']))
			$model->attributes=$_GET['Review'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Review the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Review::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Review $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
