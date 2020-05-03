<?php
if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    /**
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}

class CompanyController extends Controller
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
				'actions'=>array('index','view', 'prices', 'promo', 'ajaxloadreview'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'updateurl', 'removedouble'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAjaxloadreview()
	{
		$companyId = $_POST['companyId'];
		$page = $_POST['page'];
		$minIndex = ($page - 1) * 15;

		$model = Company::model()->findByPk($companyId);

		$reviews = array_slice($model->review, $minIndex, 15);

		$html = '';

		foreach ($reviews as $review) {
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

			$html .= '<div class="content_review_item '.($review->mark == 1 ? '__good' : ($review->mark == -1 ? '__bad' : '')).'">
						<div class="content_review_item_header">
							<span>'.$review->name.'</span> | '.$date[0]*1.0.' '.$m.' '.$date[2].' | отзыв о фирме <span>'.$review->company->name.'</span>
						</div>
						<div class="content_review_item_content">
							<p>'.$review->text.'</p>
						</div>
					</div>';
		}

		$data = [
			'html' => $html,
			'count' => count($reviews),
		];

		echo CJSON::encode($data);
		Yii::app()->end();
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$model = $this->loadModelUrl();

		$command = Yii::app()->db->createCommand();
		$command->update(
			'company',
			['views' => $model->views + 1],
			'id = :id', [':id' => $model->id]
		);

		if ($model->city_id != $this->city->id)
			$this->city = City::model()->findByPk($model->city_id);

		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$companies_count = Company::model()->count($criteria);

		// $fix_text = '<p>Компания '.$model->name.' обслуживает в '.$this->city->gorode.' физических и юридических лиц. '.mb_ucfirst($this->city->kakoy).' офис '.$model->name.' находится по адресу '.$model->address.'. Так же по вопросам покупки, установки и ремонту окон в '.$this->city->gorode.' обращаться по телефону '.$model->phone.', где вам окажут консультацию и сообщат итоговую стоимость предоставляемых услуг.</p>';
		// $about = $model->about ? $model->about.$fix_text : $fix_text;
		$about = $model->about ? $model->about : '';

		if ($model->id == 66 || $model->id == 701)
			$about = $model->about;

		$this->pageTitle = "Окна от фирмы {$model->name} в {$this->city->gorode}";
		$this->meta_k = "{$model->name} в {$this->city->gorode}, цены фирмы {$model->name}, сайт у {$model->name}, ПВХ от {$model->name}, отзывы о {$model->name}";
		$this->meta_d = "{$model->name} в {$this->city->gorode} - общая информация о компании, контактные данные и официальный сайт, цены на пластиковые окна и услуги, отзывы клиентов.";

		$this->render('view',array(
			'model' => $model,
			'about' => $about,
			'companies_count' => $companies_count,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Company;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
			$model->about = strip_tags($model->about, '<p><ul><li>');
			$model->about = preg_replace("#(</?\w+)(?:\s(?:[^<>/]|/[^<>])*)?(/?>)#ui", '$1$2', $model->about);

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

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
			$model->about = strip_tags($model->about, '<p><ul><li>');
			$model->about = preg_replace("#(</?\w+)(?:\s(?:[^<>/]|/[^<>])*)?(/?>)#ui", '$1$2', $model->about);

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/init.js');

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateUrl()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "url is NULL";
		$company = Company::model()->findAll($criteria);
		echo '1--------';
		foreach ($company as $row)
		{
			$row->url = CWord::str2url($row->name);
			$row->full_name = $row->name;
			$row->save();
		}
		echo '2--------';
	}

	public function actionRemovedouble()
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
					"	SELECT `url`, `city_id`,count(id) FROM `company` WHERE 1
						group by `url`, `city_id`
						having count(id)>1
					"
					);
		
		$dataReader=$command->query(); 
		$double = array();
		foreach($dataReader as $key=>$row) {
			$double[$key] = (object) $row;
		}
		
		echo count($double);
		foreach ($double as $row)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = "url = '".$row->url."' and city_id = ".$row->city_id;
			$criteria->order = "site ASC";
			$company = Company::model()->findAll($criteria);
			if (count($company) > 1)
				$company[0]->delete();
		}
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
		$criteria->order = "rating ASC, name ASC";
		$companies = Company::model()->findAll($criteria);
		$this->pageTitle = "Рейтинг фирм пластиковых окон в {$this->city->gorode}";
		$this->meta_k = "пластиковые окна в {$this->city->gorode}, список фирм, рейтинг компаний {$this->city->goroda}, производство окон в {$this->city->gorode}, лучшие фирмы ".date('Y')."";
		$this->meta_d = "Список лучших производителей пластиковых окон в {$this->city->gorode} по данным OKNAORG.RU";
		$this->render('index',array(
			'companies'=>$companies,
		));
	}

	public function actionPrices()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "price is not NULL and price <> '' and city_id = ".$this->city->id;
		$criteria->order = "rating ASC, name ASC";
		$companies = Company::model()->findAll($criteria);
		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$companies_count = Company::model()->count($criteria);
		$criteria = new CDbCriteria();
		$criteria->condition = "region_id = ".$this->city->region->id;
		$criteria->order = "date_create DESC";
		$pricecity = Pricecity::model()->findAll($criteria);
		$max_price = 0;
		foreach ($pricecity as $row)
		{
			$date = explode(".",date('d.m.Y', $row->date_create));
			switch ($date[1]){
				case 1: $m='янв'; break;
				case 2: $m='фев'; break;
				case 3: $m='мар'; break;
				case 4: $m='апр'; break;
				case 5: $m='май'; break;
				case 6: $m='июн'; break;
				case 7: $m='июл'; break;
				case 8: $m='авг'; break;
				case 9: $m='сен'; break;
				case 10: $m='окт'; break;
				case 11: $m='ноя'; break;
				case 12: $m='дек'; break;
			};
			$row->date_create = $m.'<br />'.$date[2];
			if ($max_price < $row->price_key)
				$max_price = $row->price_key;
		}
		$this->pageTitle = "Цены на пластиковые окна в {$this->city->gorode}";
		$this->meta_k = "окна в {$this->city->gorode}, цены в {$this->city->gorode}, калькулятор цены, стоимость окна в {$this->city->gorode}, дешевые окна {$this->city->goroda}";
		$this->meta_d = "Цены на пластиковые окна от фирм {$this->city->goroda}. Рейтинг компаний согласно соотношению цена - качество.";
		$this->render('prices',array(
			'companies' => $companies,
			'companies_count' => $companies_count,
			'pricecity' => $pricecity,
			'max_price' => $max_price,
		));
	}

	public function actionPromo()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "promo is not NULL and promo <> '' and city_id = ".$this->city->id;
		$criteria->order = "rating ASC, name ASC";
		$companies = Company::model()->findAll($criteria);
		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$companies_count = Company::model()->count($criteria);
		$this->pageTitle = "Акции и скидки на пластиковые окна в {$this->city->gorode}";
		$this->meta_k = "пластиковые окна в {$this->city->gorode}, скидки в {$this->city->gorode}, распродажа окон ".date('Y').", купить окно в {$this->city->gorode}, купить недорого в {$this->city->gorode}";
		$this->meta_d = "Выгодное предложение покупки и установки пластиковых окон в {$this->city->gorode} недорого и в рассрочку.";
		$this->render('promo',array(
			'companies' => $companies,
			'companies_count' => $companies_count,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Company the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']) && $this->city)
			$model=Company::model()->find('url=:url and city_id=:city_id', array(':url'=>$_GET['url'], ':city_id'=>$this->city->id));
		if(isset($_GET['id']))
			$model=Company::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Company $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
