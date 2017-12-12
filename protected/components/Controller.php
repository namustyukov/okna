<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='main';
	public $menu=array();
	public $breadcrumbs=array();
	public $city;
	public $show_market = 1;
	public $city_active = '1, 2, 37, 80, 99, 28, 41, 31, 49, 24, 13, 7, 72, 36, 85, 5, 23, 64, 10, 21, 108, 14, 55, 34, 67, 45, 9, 22, 83, 111, 28, 4, 73, 57, 63, 52, 25';
	public $meta_d = false;
	public $meta_k = false;
	public $pageTitle = false;
	
	/*
		SELECT concat( '<url><loc>http://oknaorg.ru/', city.simbol_name, '/news/list</loc></url>' )
		FROM city
		WHERE city.id
		IN ( 1, 2, 37, 80, 99, 28, 41, 31, 49, 24, 13, 7, 72, 36 )
		ORDER BY city.id

		select concat('<url><loc>http://oknaorg.ru/', city.simbol_name, '</loc></url>')
		from city
		where city.id in (1, 2, 37, 80, 99, 28, 41, 31, 49, 24, 13, 7, 72, 36)
		order by city.id

		select concat('<url><loc>http://oknaorg.ru/', city.simbol_name, '/company/', company.url, '</loc></url>')
		from city, company
		where company.city_id = city.id
		and city.id in (1, 2, 37, 80, 99, 28, 41, 31, 49, 24, 13, 7, 72, 36)
		order by city.id
	*/
	
	function __construct($id){
		parent::__construct($id);
		
		// Yii::app()->getClientScript()->registerScriptFile('/tiny_mce/tiny_mce.js');
		// Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
		if (Yii::app()->params['city']) 
		{
			$this->city = City::model()->find('simbol_name=:simbol_name', array(':simbol_name'=>Yii::app()->params['city']));
			Yii::app()->session['city'] = $this->city->id;
			Yii::app()->request->cookies['city'] = new CHttpCookie('city', $this->city->id);
			if ($this->city==NULL){
				throw new ExceptionClass('404 Not found');
			}
		}
		else
		{
			$this->city = false;
			if (isset(Yii::app()->session['city']))
				$this->city = City::model()->findbyPk(Yii::app()->session['city']);
			else
			if (Yii::app()->request->cookies['city']->value)
				$this->city = City::model()->findbyPk(Yii::app()->request->cookies['city']->value);
			if (!$this->city)
			{
				$criteria = new CDbCriteria();
				$criteria->condition='id=:id';
				$criteria->params=array(':id'=>1);
				$city_first = City::model()->find($criteria);
				$this->city = $city_first;
			}
		}

		/*-----------новости-------------*/
		$news = News::model()->find('date_create=:date_create', array(':date_create' => mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y'))));
		if (!$news)
		{
			$types = array('address', 'phone', 'site', 'worktime', 'online', 'certificate', 'guarantee', 'payment', 'price', 'promo', 'about');
			$cities = City::model()->findAll(array('order'=>'gorod'));
			foreach ($cities as $row)
			{
				shuffle($types);
				foreach ($types as $order) {
					$criteria = new CDbCriteria();
					$criteria->condition = "city_id = {$row->id} and {$order} is not null and {$order}<>''";
					$companies = Company::model()->findAll($criteria);
					if (count($companies))
					{
						shuffle($companies);
						$model = new News;
						$model->type = 'update';
						$model->date_create = mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y'));
						$model->company_id = $companies[0]->id;
						$model->city_id = $row->id;
						$variety = array();
						switch ($order) {
							case 'address':
								$variety = array(
									"В {$row->gorode} по адресу {$companies[0]->address} открылся офис фирмы {company}.",
									"Изменился адрес производственной компании {company} в городе {$row->gorod}. Офис и отдел продаж теперь находится по адресу {$companies[0]->address}.",
									"Отдел продаж пластиковых окон от фирмы {company} теперь находится по адресу {$companies[0]->address}. Более подробную информацию об организации, ее услугах и контактные данные возможно получить на странице компании.",
								);
								break;
							case 'phone':
								$variety = array(
									"У компании {company} изменился номер телефона офиса, находящегося в городе {$row->gorod}. Актуальный номер телефона: {$companies[0]->phone}. Менеджер компании ответит на все ваши вопросы, а так же примет заявку на замеры.",
									"Добавлен телефон {$companies[0]->phone} для оформления заказа на покупку пластиковых окон от фирмы {company} в {$row->gorode}. По данному телефону так же можно уточнить информацию о стоимости монтажа и установки окон.",
								);
								break;
							case 'site':
								$variety = array(
									"Изменился официальный сайт компании {company}. Актуальные данные об организации представлены на ресурсе {$companies[0]->site}.",
									"Фирма {company} обновила дизайн своего сайта, находящегося по адресу {$companies[0]->site}. На наш взгляд сайт стал более удобным и привлекательным для покупателей.",
								);
								break;
							case 'worktime':
								$variety = array(
									"Изменено время работы офиса компании {company}, находящегося по адресу г. {$row->gorod}, {$companies[0]->address}. Текущий график работы: {$companies[0]->worktime}."
								);
								break;
							case 'online':
								$variety = array(
									"На официальном сайте компании {company} добавлена возможность подачи онлайн-заявки на установку пластикового окна в пределах {$row->goroda}. После подачи заявки с вами свяжется менеджер компании, с которым вы обговорите интересующие вас вопросы и будет назначено время вызова мастера для предварительных замеров."
								);
								break;
							case 'certificate':
								$variety = array(
									"Фирма {company} получила очередной сертификат соответствия и качества на производство пластиковых окон. Были проведены необходимые сертификационные испытания оконных блоков и стеклопакетов, оформлена декларация соответствия."
								);
								break;
							case 'guarantee':
								$variety = array(
									"{company} увеличила срок гарантии на установку окон. Гарантийные обязательства фирмы составляют: {$companies[0]->guarantee}. Будте бдительны и проверяйте срок гарантии при заключении договора."
								);
								break;
							case 'payment':
								$variety = array(
									"Для клиентов фирмы {company} добавлен новый способ оплаты заказа. Теперь имеется возможность оплачивать счет следующими способами: {$companies[0]->payment}. Оплата производится в отделе продаж по адресу {$companies[0]->address}."
								);
								break;
							case 'price':
								$variety = array(
									"Снижена цена пластиковых окон от фирмы {company}. На странице компании указана минимальная стоимость окна за квадратный метр. Для уточнения информации необходимо связаться с менеджерами фирмы по телефону {$companies[0]->phone}, либо прийти в офис, который находится по адресу {$companies[0]->address}."
								);
								break;
							case 'promo':
								$variety = array(
									"Расширен набор акций, скидок и выгодных предложений от {company}. Подробнее об условиях акции можно узнать на сайте компании {$companies[0]->site}."
								);
								break;
							case 'about':
								$variety = array(
									"Обновлена информация о фирме {company}, находящейся в городе {$row->gorod}. Мы актуализировали сводные данные о компании, в том числе: контактные данные, перечень услуг, предлагаемые цены и гарантийные обязательства."
								);
								break;
						}
						shuffle($variety);
						$model->preview = $variety[0];
						$model->save();
						break;
					}
				}
			}
		}
		/*-------------------------------*/
	}
}