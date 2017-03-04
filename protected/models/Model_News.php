<?php

/**
 * This is the model class for table "tbl_news".
 *
 * The followings are the available columns in table 'tbl_news':
 * @property string $news_id
 * @property integer $admin_id
 * @property string $news_date
 * @property string $news_time
 * @property string $news_heading
 * @property string $news_body
 *
 * The followings are the available model relations:
 * @property TblAdmin $admin
 */
class Model_News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_heading, news_body', 'required'),
			array('admin_id', 'numerical', 'integerOnly'=>true),
			array('news_date, news_time', 'length', 'max'=>20),
			array('news_heading', 'length', 'max'=>200),
			array('news_body', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('news_id, admin_id, news_date, news_time, news_heading, news_body', 'safe', 'on'=>'search'),
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
			'admin' => array(self::BELONGS_TO, 'TblAdmin', 'admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news_id' => 'News',
			'admin_id' => 'Admin',
			'news_date' => 'News Date',
			'news_time' => 'News Time',
			'news_heading' => 'News Heading',
			'news_body' => 'News Body',
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

		$criteria->compare('news_id',$this->news_id,true);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('news_date',$this->news_date,true);
		$criteria->compare('news_time',$this->news_time,true);
		$criteria->compare('news_heading',$this->news_heading,true);
		$criteria->compare('news_body',$this->news_body,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
