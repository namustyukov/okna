<?php

function compare($x, $y)
{
	if ($x->koord_x == $y->koord_x)
		return 0;
	else if ($x->koord_x < $y->koord_x)
		return -1;
	else
		return 1;
}

class SiteController extends Controller
{
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
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionHelp()
	{
		$this->pageTitle = "Поддержка проекта OKNAORG.RU для дальнейшего развития.";
		$this->meta_k = "помощь, поддержать, развитие, проект, окна, перечислить, деньги";
		$this->meta_d = "Если вы хотите поддержать проект OKNAORG.RU, то на сайте доступен функционал перевода денежных средств, которые будут потрачены на развитие проекта.";
		$this->render('help',array(
		));
	}

	public function actionSuccess()
	{
		$this->pageTitle = "Перевод успешно принят.";
		$this->render('success',array(
		));
	}

	public function actionOut()
	{
		$id = $_GET['id'];
		if ($id == 1)
			$url = 'https://alitems.com/g/0f6070242d6fced429e416525dc3e8/?i=4';
		Header ("Location:".$url);
		Yii::app()->end();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionIndex_gorod()
	{
		$criteria_news = new CDbCriteria();
		$criteria_news->condition = "city_id = ".$this->city->id;
		$criteria_news->order = "date_create DESC";
		$criteria_news->limit = 10;
		$news = News::model()->findAll($criteria_news);

		$promoes = Company::model()->findAll(array(
			'condition' => 'length(promo) > 0 and city_id = '.$this->city->id,
			'order' => 'rating ASC',
		));

		/*$cities = City::model()->findAll(array('order'=>'gorod'));
		foreach ($cities as $row)
			$row->koord_x = $row->region->price[0]->price + $row->id;
		usort ($cities, 'compare');
		$rating_city = 0;
		foreach ($cities as $row)
		{
			$rating_city++;
			$row->rating = $rating_city;
			$row->save();
		}*/

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
		$companies_price = Company::model()->findAll(array(
			'condition' => 'length(price) > 0 and city_id = '.$this->city->id,
			'order' => 'rating ASC',
		));

		/*$text = "
			<p>В ".$this->city->gorode." представлено ".count($this->city->company)." оконных компаний. Помимо фирм, осуществляющих продажу и установку пластиковых окон, имеются компании специализирующиеся на следующих услугах:</p>
			<ul>
				<li>ремонт окон,</li>
				<li>остекление балконов и лоджий,</li>
				<li>изготовление оконной фурнитуры,</li>
				<li>установка и монтаж окон,</li>
				<li>изготовление деревянных окон,</li>
				<li>производство алюминиевых оконных конструкций и других.</li>
			</ul>
			<p>Одним из показателей качества окон является профиль конструкции. Среди ".$this->city->kakih." фирм проведена оценка используемых профилей ПВХ:</p>
			<ul>
				<li>Exprof (Экспроф),</li>
				<li>Salamander (Саламандер),</li>
				<li>KBE (КБЕ),</li>
				<li>Proplex (Проплекс),</li>
				<li>Rehau (Рехау),</li>
				<li>Veka (Века),</li>
				<li>Trocal (Трокаль),</li>
				<li>Novotex (Новотекс),</li>
				<li>Roto (Рото) и другие.</li>
			</ul>
			<p>Выявлено, что значительный перевес у профиля немецкой марки Rehau. Более ".rand(60,80)."% всех фирм ".$this->city->goroda." используют именно его. Вы можете в этом убедиться. На странице каждой из представленных на сайте компаний имеется информация о том, какие марки оконных профилей используются в производстве.</p>
			<p>В разделе Цены и Акции Вы сможете подобрать недорогие окна для дома или квартиры. Однако если для Вас важно качество окон, адекватность цен, репутация и надежность фирмы, то Вы можете сделать свой выбор на основе рейтинга компаний ".$this->city->goroda.", составленного специалистами ОКНАОРГ.РУ.</p>
			<p>Если вопрос выбора фирмы все равно остается актуальным, то Вам несомненно помогут мнения и советы других покупателей из ".$this->city->goroda.". Ознакомиться с ними можно в разделе Отзывы.</p>
			<p>Надеемся, что с нашей помощью, Вы подберете для себя самые оптимальные предложения от ведущих ".$this->city->kakih." компаний, которые удовлетворят все Ваши потребности.</p>
		";*/

		$text = "";

		$this->pageTitle = "Пластиковые окна и конструкции ПВХ в {$this->city->gorode}";
		$this->meta_k = "пластиковые окна в {$this->city->gorode}, стоимость окна в {$this->city->gorode}, продажа окон в {$this->city->gorode}, фирмы, акции, отзывы клиентов";
		$this->meta_d = "Собрана информация о компаниях {$this->city->goroda}, отзывах покупателей, приведена динамика цен на пластиковые окна за ".date('Y')." год.";

		$this->render('index_gorod',array(
			'promoes' => $promoes,
			'text' => $text,
			'news' => $news,
			'pricecity' => $pricecity,
			'max_price' => $max_price,
			'companies_price' => $companies_price,
		));
	}
	
	public function actionIndex()
	{
		$cities = City::model()->findAll(array('order'=>'gorod', 'condition'=>'id in ('.$this->city_active.')'));
		$criteria = new CDbCriteria();
		$criteria->order = "date_create DESC";
		$criteria->limit = 10;
		$news = News::model()->findAll($criteria);
		$count_company = 0;
		$count_news = 0;
		$count_review = 0;
		$count_promo = 0;
		$count_city = City::model()->count();
		$count_company = Company::model()->count();
		$count_news = News::model()->count();
		$count_review = Review::model()->count();
		
		$count_promo = Company::model()->count(array('condition'=>'length(promo) > 0'));
		$count_price = Company::model()->count(array('condition'=>'length(price) > 0'));

		$page_list = Page::model()->findAll(array(
			'order' => 'date_create DESC',
			'limit' => 5,
		));
		
		$this->pageTitle = "ОКНАОРГ.РУ - крупнейший справочник оконных компаний";
		$this->meta_k = "пластиковые окна, новости, цены, отзывы, производство окон, список компаний, стоимость окон ".date('Y')."";
		$this->meta_d = "ОКНАОРГ.РУ - пластиковые окна и производство окон ПВХ в России. Всегда свежие новости оконных фирм с актуальными ценами, акциями и отзывами покупателей.";

		$this->render('index',array(
			'cities' => $cities,
			'news' => $news,
			'count_company' => $count_company,
			'count_news' => $count_news,
			'count_review' => $count_review,
			'count_promo' => $count_promo,
			'count_price' => $count_price,
			'count_city' => $count_city,
			'page_list' => $page_list,
		));
	}

	public function actionMap()
	{
		$page_list = Page::model()->findAll(array(
			'order' => 'date_create DESC'
		));
		$city = City::model()->findAll(array('order'=>'gorod'));
		$this->pageTitle = "Карта сайта OKNAORG.RU";
		$this->meta_k = "карта сайта, окнаорг, oknaorg";
		$this->meta_d = "Карта сайта OKNAORG.RU";

		$this->render('map',array(
			'city' => $city,
			'page_list' => $page_list,
		));
	}

	public function actionAjaxfeedback()
	{
		$feedback_name = $_POST['feedback_name'];
		$feedback_email = $_POST['feedback_email'];
		$feedback_message = $_POST['feedback_message'];
		$url = $_POST['url'];

		$model = new Feedback;
		$model->name = $feedback_name;
		$model->email = $feedback_email;
		$model->message = $feedback_message;
		$model->url = $url;
		$model->save();

		$data='';
		$data.="URL: ".$url."<br />";
		$data.="Имя: ".$feedback_name."<br />";
		$data.="E-mail: ".$feedback_email."<br />";
		$data.="Текст:<br />".$feedback_message;
		$to  = "oknaorg <oknaorg@mail.ru>" ;
		$subject = "Сообщение от пользователя | OKNAORG.RU";
		$message = $data;
		$headers  = "Content-type: text/html; charset=utf8 \r\n";
		$headers .= "From: OKNAORG.RU <oknaorg.ru>\r\n";
		mail($to, $subject, $message, $headers);
		echo 'good';
		Yii::app()->end();
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
