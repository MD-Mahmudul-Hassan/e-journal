<?php

/**
 * This is the model class for table "tbl_blog".
 *
 * The followings are the available columns in table 'tbl_blog':
 * @property integer $comment_id
 * @property string $email
 * @property string $user_name
 * @property string $comment_date
 * @property string $comment_time
 * @property string $comment_message
 *
 * The followings are the available model relations:
 * @property TblEmail $email0
 */
class Model_blog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_message', 'required'),
			array('email, comment_date,comment_time,user_name', 'length', 'max'=>100),
			array('comment_message', 'length', 'max'=>1500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('comment_id, email,comment_date, comment_time, comment_message', 'safe', 'on'=>'search'),
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
			'comment_id' => 'Comment ID',
			'email' => 'Email',
			'comment_date' => 'Comment Date',
			'comment_time' => 'Comment Time',
			'comment_message' => 'Message',
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

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('email',$this->email,true);
                $criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('comment_date',$this->comment_date,true);
		$criteria->compare('comment_time',$this->comment_time,true);
		$criteria->compare('comment_message',$this->comment_message,true);

		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_blog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
