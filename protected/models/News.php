<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $url
 * @property integer $date_create
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $preview
 * @property string $content
 * @property string $view_count
 * @property string $url_info
 * @property integer $company_id
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, 	url, 	date_create, 	title, 	keywords, 	description, 	preview, 	content, 	view_count, 	url_info, 	type, 	company_id, 	city_id', 'safe'),
			array('id, 	url, 	date_create, 	title, 	keywords, 	description, 	preview, 	content, 	view_count, 	url_info, 	type, 	company_id, 	city_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'date_create' => 'Дата создания',
			'title' => 'Заголовок',
			'keywords' => 'Ключевые слова (meta-keywords)',
			'description' => 'Описание (meta-description)',
			'preview' => 'Краткое описание (анонс)',
			'content' => 'Текст новости',
			'view_count' => 'Количество просмотров',
			'url_info' => 'Откуда информация (донор)',
			'type' => 'Тип',
			'company_id' => 'Компания',
			'city_id' => 'Город',
		);
	}
	
	public function getCompanyOptions() {
		$connection=Yii::app()->db;
		$where_city = '';
		if ($this->city)
			$where_city = ' and city.id = '.$this->city->id;
		$command=$connection->createCommand(
			"SELECT distinct company.id, company.name, city.gorod
			FROM company, city
			WHERE company.city_id = city.id
			".$where_city."
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

	public function getCompanyOrder() {
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
			"SELECT distinct company.id, company.name, company.url, (select count(id) from news where company_id = company.id) as count, company.rating
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('url_info',$this->url_info,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('view_count',$this->view_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		if (!$this->date_create)
			$this->date_create = mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y'));
		if (!$this->url) $this->url = CWord::str2url($this->title);
		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
