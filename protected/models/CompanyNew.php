<?php

/**
 * This is the model class for table "company_new".
 *
 * The followings are the available columns in table 'company_new':
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $worktime
 * @property integer $rating
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
 * @property string $user_email
 * @property integer $is_accept
 * @property string $koord_x
 * @property string $koord_y
 * @property string $date_modify
 */
class CompanyNew extends CActiveRecord
{
	public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company_new';
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
			array('rating, city_id, is_accept', 'numerical', 'integerOnly'=>true),
			array('name, email, site, worktime, date_found, url', 'length', 'max'=>100),
			array('full_name, address, phone, online, certificate, guarantee, payment, promo, production_way, logo, donor_site, user_email', 'length', 'max'=>300),
			array('price', 'length', 'max'=>500),
			array('koord_x, koord_y', 'length', 'max'=>50),
			array('about', 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, full_name, address, phone, email, site, worktime, rating, online, date_found, certificate, guarantee, payment, price, promo, production_way, about, logo, city_id, donor_site, url, user_email, is_accept, koord_x, koord_y, date_modify', 'safe', 'on'=>'search'),
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
			'insite' => array(self::BELONGS_TO, 'Company', 'donor_site'),
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
			'full_name' => 'Полное наименование',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'email' => 'Email',
			'site' => 'Сайт',
			'worktime' => 'Время работы',
			'online' => 'Online заказ',
			'date_found' => 'Дата основания компании (год)',
			'certificate' => 'Сертификаты',
			'guarantee' => 'Гарантия (количество лет)',
			'payment' => 'Способы оплаты',
			'price' => 'Цена',
			'promo' => 'Акции',
			'production_way' => 'Способ производства',
			'about' => 'О компании',
			'logo' => 'Логотип',
			'city_id' => 'Город',
			'donor_site' => 'Откуда информация (донор)',
			'url' => 'Url',
			'is_accept' => 'Принято',
			'user_email' => 'Ваш email',
			'verifyCode' => 'Код подтверждения',
			'koord_x' => 'Koord X',
			'koord_y' => 'Koord Y',
			'date_modify' => 'Date Modify',
		);
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
		$criteria->compare('rating',$this->rating);
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
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('is_accept',$this->is_accept);
		$criteria->compare('koord_x',$this->koord_x,true);
		$criteria->compare('koord_y',$this->koord_y,true);
		$criteria->compare('date_modify',$this->date_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		$this->date_modify = NULL;
		$this->url = CWord::str2url($this->name);

		if (!$this->full_name)
			$this->full_name = $this->name;

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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompanyNew the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
