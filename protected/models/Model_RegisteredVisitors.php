<?php

/**
 * This is the model class for table "tbl_registered_visitors".
 *
 * The followings are the available columns in table 'tbl_registered_visitors':
 * @property integer $visitor_id
 * @property string $visitor_first_name
 * @property string $visitor_last_name
 * @property string $email
 *
 * The followings are the available model relations:
 * @property TblEmail $email0
 */
class Model_RegisteredVisitors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_registered_visitors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visitor_first_name, visitor_last_name, email', 'required'),
			array('visitor_first_name, visitor_last_name, email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('visitor_id, visitor_first_name, visitor_last_name, email', 'safe', 'on'=>'search'),
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
			'email0' => array(self::BELONGS_TO, 'TblEmail', 'email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'visitor_id' => 'Visitor',
			'visitor_first_name' => 'Visitor First Name',
			'visitor_last_name' => 'Visitor Last Name',
			'email' => 'Email',
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

		$criteria->compare('visitor_id',$this->visitor_id);
		$criteria->compare('visitor_first_name',$this->visitor_first_name,true);
		$criteria->compare('visitor_last_name',$this->visitor_last_name,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_RegisteredVisitors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
