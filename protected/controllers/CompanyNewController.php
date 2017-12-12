<?php

class CompanyNewController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'foreColor'=>0x4C8E4D,
				'height'=>100,
				'width'=>300,
			),
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
				'actions'=>array('view','create','update','delete','captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'accept', 'acceptall'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAcceptall()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "is_accept is NULL OR is_accept = 0";
		$company = CompanyNew::model()->findAll($criteria);

		echo 'Count = '.count($company);
		echo '<br>--------begin----------<br>';

		$count = 0;

		foreach ($company as $model) {
			$criteria = new CDbCriteria();
			$criteria->condition = "url = '".trim($model->url)."' AND city_id = ".$model->city_id."";
			$same = Company::model()->find($criteria);

			if (!$same) {
				$company = new Company;
				$company->city_id = $model->city_id;
				$company->name = trim($model->name);
				$company->full_name = trim($model->full_name);
				$company->address = trim($model->address);
				$company->phone = trim($model->phone);
				$company->email = trim($model->email);
				$company->site = trim($model->site);
				$company->worktime = trim($model->worktime);
				$company->online = trim($model->online);
				$company->date_found = trim($model->date_found);
				$company->certificate = trim($model->certificate);
				$company->guarantee = trim($model->guarantee);
				$company->payment = trim($model->payment);
				$company->price = trim($model->price);
				$company->promo = trim($model->promo);
				$company->production_way = trim($model->production_way);
				$company->about = trim($model->about);
				$company->logo = $model->logo;
				$company->url = trim($model->url);
				$company->donor_site = $model->id;
				$company->save();
	
				$model->donor_site = $company->id;
				$model->is_accept = 1;
				$model->save(false);

				$count++;
			}
		}

		echo 'insert = '.$count;
		echo '<br>--------end----------<br>';
	}

	public function actionAccept($id)
	{
		$model = $this->loadModelUrl();

		if ($model)
		{
			$company = new Company;
			$company->city_id = $model->city_id;
			$company->name = $model->name;
			$company->full_name = $model->full_name;
			$company->address = $model->address;
			$company->phone = $model->phone;
			$company->email = $model->email;
			$company->site = $model->site;
			$company->worktime = $model->worktime;
			$company->online = $model->online;
			$company->date_found = $model->date_found;
			$company->certificate = $model->certificate;
			$company->guarantee = $model->guarantee;
			$company->payment = $model->payment;
			$company->price = $model->price;
			$company->promo = $model->promo;
			$company->production_way = $model->production_way;
			$company->about = $model->about;
			$company->logo = $model->logo;
			$company->url = $model->url;
			$company->donor_site = $model->id;
			$company->save();

			$model->donor_site = $company->id;
			$model->is_accept = 1;
			$model->save(false);

			$data = 'Добрый день! Ваша компания размещена на сайте oknaorg.ru. Ссылка - <a href="http://oknaorg.ru/'.$company->city->simbol_name.'/company/'.$company->url.'">'.$company->name.'</a>';
			$data .= '<br><br>Данное письмо сгенерировано автоматически, просьба на него не отвечать. Если у Вас появились вопросы, то свяжитесь с нами по адресу oknaorg@mail.ru .';
			$data .= '<br><br>--<br>С уважением,<br>Oknaorg.ru - городской портал об окнах';
			$to = "<{$model->user_email}>" ;
			$subject = "Ваша компания размещена на сайте OKNAORG.RU";
			$message = $data;
			$headers  = "Content-type: text/html; charset=utf8 \r\n";
			$headers .= "From: OKNAORG.RU <oknaorg>\r\n";
			mail($to, $subject, $message, $headers);

			/*$to = "<oknaorg@mail.ru>";
			mail($to, $subject, $message, $headers);*/

			$this->redirect('/'.$company->city->simbol_name.'/company/'.$company->url);
		}

		$this->render('view',array(
			'model' => $model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModelUrl();

		if ($model->city_id != $this->city->id)
			$this->city = City::model()->findByPk($model->city_id);

		$this->render('view',array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CompanyNew;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CompanyNew']))
		{
			$model->attributes=$_POST['CompanyNew'];
			$model->about = strip_tags($model->about, '<p><ul><li>');
			$model->about = preg_replace("#(</?\w+)(?:\s(?:[^<>/]|/[^<>])*)?(/?>)#ui", '$1$2', $model->about);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/init.js');

		$this->pageTitle = "Добавить компанию на сайт про окна";
		$this->meta_k = "сайт, добавить, окна, компания, моя компания";
		$this->meta_d = "Размещение информации о компании на сайте пластиковых окон oknaorg.ru";

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

		if(isset($_POST['CompanyNew']))
		{
			$model->attributes=$_POST['CompanyNew'];
			$model->about = strip_tags($model->about, '<p><ul><li>');
			$model->about = preg_replace("#(</?\w+)(?:\s(?:[^<>/]|/[^<>])*)?(/?>)#ui", '$1$2', $model->about);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/init.js');

		$this->pageTitle = "Редактировать компанию на сайт про окна";
		$this->meta_k = "сайт, изменить, окна, компания, редактировать";
		$this->meta_d = "Изменить информации о компании на сайте пластиковых окон oknaorg.ru";

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
			$this->redirect('/');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CompanyNew');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CompanyNew('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CompanyNew']))
			$model->attributes=$_GET['CompanyNew'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CompanyNew the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CompanyNew::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']) && $this->city)
			$model=CompanyNew::model()->find('url=:url and city_id=:city_id', array(':url'=>$_GET['url'], ':city_id'=>$this->city->id));
		if(isset($_GET['id']))
			$model=CompanyNew::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CompanyNew $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-new-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
