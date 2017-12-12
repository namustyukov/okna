<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property string $text
 * @property string $name
 * @property integer $mark
 * @property integer $company_id
 * @property integer $news_id
 * @property integer $add_time
 * @property string $date_modify
 */
class Review extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			array('mark, company_id, city_id, news_id, add_time', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, text, name, mark, company_id, city_id, news_id, add_time, date_modify', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Текст',
			'name' => 'Имя',
			'mark' => 'Оценка',
			'company_id' => 'Компания',
			'city_id' => 'Город',
			'news_id' => 'Новость',
			'add_time' => 'Add Time',
			'date_modify' => 'Date Modify',
		);
	}

	public function getCompanyOrder() {
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
			"SELECT distinct company.id, company.name, company.url, (select count(id) from review where company_id = company.id) as count, company.rating
			FROM company
			WHERE company.city_id = {$this->city->id}
			order by 4 desc, 2 asc
			"
		);
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
		}
		return $rows;
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('date_modify',$this->date_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		$this->date_modify = NULL;
		if (Yii::app()->controller->action->id != 'update')
		{
           $this->add_time = time();
		}
		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
