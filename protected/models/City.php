<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $id
 * @property string $gorod
 * @property string $goroda
 * @property string $gorode
 * @property string $gorodu
 * @property string $kakih
 * @property string $kakie
 * @property string $kakimi
 * @property string $kakuyu
 * @property string $kakoy
 * @property string $kakom
 * @property string $kakaya
 * @property string $simbol_name
 * @property string $koord_x
 * @property string $koord_y
 * @property string $date_modify
 */
class City extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gorod', 'required'),
			array('region_id, rating', 'numerical', 'integerOnly'=>true),
			array('gorod, goroda, gorode, gorodu, kakih, kakie, kakimi, kakuyu, kakoy, kakom, kakaya, simbol_name', 'length', 'max'=>200),
			array('koord_x, koord_y', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gorod, goroda, gorode, gorodu, kakih, kakie, kakimi, kakuyu, kakoy, kakom, kakaya, simbol_name, region_id, rating, koord_x, koord_y, date_modify', 'safe', 'on'=>'search'),
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
			'news' => array(self::HAS_MANY, 'News', 'city_id'),
			'reviews' => array(self::HAS_MANY, 'Review', 'city_id', 'order'=>'reviews.add_time DESC'),
			'company' => array(self::HAS_MANY, 'Company', 'city_id', 'order'=>'company.rating ASC'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gorod' => 'Город',
			'goroda' => 'Города',
			'gorode' => 'Городе',
			'gorodu' => 'Городу',
			'kakih' => 'Каких',
			'kakie' => 'Какие',
			'kakimi' => 'Какими',
			'kakuyu' => 'Какую',
			'kakoy' => 'Какой',
			'kakom' => 'Каком',
			'kakaya' => 'Какая',
			'simbol_name' => 'URL',
			'region_id' => 'Region',
			'koord_x' => 'Koord X',
			'koord_y' => 'Koord Y',
			'date_modify' => 'Date Modify',
		);
	}

	public function getCityRating() {
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
			"SELECT DISTINCT city.id, count(company.id) as count_company
			FROM company, city
			WHERE company.city_id = city.id
			GROUP BY city.id
			ORDER BY 2 DESC
			"
		);
		$dataReader=$command->query();

		foreach($dataReader as $key => $row) {
			if ($row['id'] == $this->city->id) break;
		}

		return $key;
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
		$criteria->compare('gorod',$this->gorod,true);
		$criteria->compare('goroda',$this->goroda,true);
		$criteria->compare('gorode',$this->gorode,true);
		$criteria->compare('gorodu',$this->gorodu,true);
		$criteria->compare('kakih',$this->kakih,true);
		$criteria->compare('kakie',$this->kakie,true);
		$criteria->compare('kakimi',$this->kakimi,true);
		$criteria->compare('kakuyu',$this->kakuyu,true);
		$criteria->compare('kakoy',$this->kakoy,true);
		$criteria->compare('kakom',$this->kakom,true);
		$criteria->compare('kakaya',$this->kakaya,true);
		$criteria->compare('simbol_name',$this->simbol_name,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('koord_x',$this->koord_x,true);
		$criteria->compare('koord_y',$this->koord_y,true);
		$criteria->compare('date_modify',$this->date_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$this->date_modify = NULL;
		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
