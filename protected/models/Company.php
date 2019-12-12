<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $worktime
 * @property string $online
 * @property string $date_found
 * @property string $certificate
 * @property string $guarantee
 * @property string $payment
 * @property string $price
 * @property string $promo
 * @property string $production_way
 * @property string $about
 * @property string $logo
 * @property integer $city_id
 * @property string $donor_site
 * @property string $url
 * @property string $koord_x
 * @property string $koord_y
 * @property string $date_modify
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('city_id', 'numerical', 'integerOnly'=>true),
			array('name, full_name, address, phone, email, site, worktime, online, date_found, certificate, guarantee, payment, price, promo, production_way, url', 'length', 'max'=>500),
			array('logo, donor_site', 'length', 'max'=>300),
			array('koord_x, koord_y', 'length', 'max'=>50),
			array('about', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, full_name, address, phone, email, site, worktime, rating, online, date_found, certificate, guarantee, payment, price, promo, production_way, about, logo, city_id, donor_site, url, koord_x, koord_y, date_modify', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'news' => array(self::HAS_MANY, 'News', 'company_id', 'order'=>'news.date_create DESC'),
			'review' => array(self::HAS_MANY, 'Review', 'company_id', 'order'=>'review.add_time DESC'),
			'service' => array(self::HAS_MANY, 'CompanyService', 'company_id'),
			/*'likes' => array(self::HAS_MANY, 'Likes', 'company_id'),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Наименование',
			'full_name' => 'Полное имя',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'email' => 'Email',
			'site' => 'Сайт (компании)',
			'worktime' => 'Время работы',
			'online' => 'Online заказ',
			'date_found' => 'Дата основания',
			'certificate' => 'Сертификаты',
			'guarantee' => 'Гарантия',
			'payment' => 'Способы оплаты',
			'price' => 'Цена',
			'promo' => 'Акции',
			'production_way' => 'Способ производства',
			'about' => 'О компании',
			'logo' => 'Логотип',
			'city_id' => 'Город',
			'donor_site' => 'Откуда информация (донор)',
			'url' => 'Url',
			'koord_x' => 'Koord X',
			'koord_y' => 'Koord Y',
			'date_modify' => 'Date Modify',
		);
	}
	
	public function getCompanyOptions() {
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
			"SELECT distinct company.id, company.name, city.gorod
			FROM company, city
			WHERE company.city_id = city.id
			order by city.gorod, company.name
			"
		);
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
		}
		$b = array(''=>'');
		foreach ($rows as $row){
			$b[$row->id] = $row->gorod.' - '.$row->name;
		}
		return $b;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('worktime',$this->worktime,true);
		$criteria->compare('online',$this->online,true);
		$criteria->compare('date_found',$this->date_found,true);
		$criteria->compare('certificate',$this->certificate,true);
		$criteria->compare('guarantee',$this->guarantee,true);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('promo',$this->promo,true);
		$criteria->compare('production_way',$this->production_way,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('donor_site',$this->donor_site,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('koord_x',$this->koord_x,true);
		$criteria->compare('koord_y',$this->koord_y,true);
		$criteria->compare('date_modify',$this->date_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$this->date_modify = NULL;
		if (!$this->url) $this->url = CWord::str2url($this->name);

		if (strlen($this->logo) < 1) {
			// загружаем изображение
			$this->logo = CUploadedFileEx::getInstance($this,'logo');

			// если загрузили
			if ($this->logo<>NULL) {
				// задаём имя новому файлу
				$this->logo->setName($this->url.'_'.rand(1, 10000));

				// сохраняем файл
				$this->logo->saveAs('img/' . $this->logo->getName());
			}else{
				unset($this->logo);
			}
		}
		return parent::beforeSave();
	}

	public function afterSave() {
		$city_id = $this->city_id;
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
			"SELECT id,
			priority,
			(
				IF(LENGTH(address) > 0, 1, 0) +
				IF(LENGTH(phone) > 0, 1, 0) +
				IF(LENGTH(email) > 0, 1, 0) +
				IF(LENGTH(site) > 0, 1, 0) +
				IF(LENGTH(site) > 0, 1, 0) +
				IF(LENGTH(site) > 0, 1, 0) +
				IF(LENGTH(worktime) > 0, 1, 0) +
				IF(LENGTH(online) > 0, 1, 0) +
				IF(LENGTH(online) > 0, 1, 0) +
				IF(LENGTH(date_found) > 0, 1, 0) +
				IF(LENGTH(certificate) > 0, 1, 0) +
				IF(LENGTH(certificate) > 0, 1, 0) +
				IF(LENGTH(certificate) > 0, 1, 0) +
				IF(LENGTH(guarantee) > 0, 1, 0) +
				IF(LENGTH(guarantee) > 0, 1, 0) +
				IF(LENGTH(guarantee) > 0, 1, 0) +
				IF(LENGTH(payment) > 0, 1, 0) +
				IF(LENGTH(payment) > 0, 1, 0) +
				IF(LENGTH(payment) > 0, 1, 0) +
				IF(LENGTH(price) > 0, 1, 0) +
				IF(LENGTH(price) > 0, 1, 0) +
				IF(LENGTH(promo) > 0, 1, 0) +
				IF(LENGTH(promo) > 0, 1, 0) +
				IF(LENGTH(promo) > 0, 1, 0) +
				IF(LENGTH(production_way) > 0, 1, 0) +
				IF(LENGTH(production_way) > 0, 1, 0) +
				IF(LENGTH(production_way) > 0, 1, 0) +
				IF(LENGTH(about) > 0, 1, 0) +
				(select count(id) from company_service where company_id = company.id) +
				(select COUNT(id) from review where company_id = company.id AND mark = 1) -
				(select COUNT(id) from review where company_id = company.id AND mark = -1)
			) as info,
			IF(LENGTH(promo) > 0, 1, 0),
			IF(LENGTH(payment) > 0, 1, 0),
			IF(LENGTH(guarantee) > 0, 1, 0),
			IF(LENGTH(certificate) > 0, 1, 0),
			IF(LENGTH(online) > 0, 1, 0),
			IF(LENGTH(price) > 0, 1, 0),
			IF(LENGTH(production_way) > 0, 1, 0),
			(select count(id) from company_service where company_id = company.id),
			IF(LENGTH(site) > 0, 1, 0),
			(select count(id) from news where company_id = company.id),
			LENGTH(about)
			FROM company
			WHERE company.city_id = {$city_id}
			order by 2 DESC, 3 DESC, 4 DESC, 5 DESC, 6 DESC, 7 DESC, 8 DESC, 9 DESC, 10 DESC, 11 DESC, 12 DESC, 13 DESC, 14 DESC
			"
		);
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
			$command_upd = $connection->createCommand("update company set rating = ".($key + 1)." where id = {$rows[$key]->id}");
			$command_upd->query();
		}
		return parent::afterSave();
	}

	public function beforeDelete() {
		foreach ($this->news as $row)
			$row->delete();
		return parent::beforeDelete();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
