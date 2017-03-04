<?php

/**
 * This is the model class for table "tbl_live_chat".
 *
 * The followings are the available columns in table 'tbl_live_chat':
 * @property string $chat_id
 * @property string $email
 * @property string $chat_date
 * @property string $chat_time
 * @property string $chat_message
 * @property string $chat_pass_code
 * @property string $profile_image_url
 * The followings are the available model relations:
 * @property TblEmail $email0
 */
class Model_LiveChat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_live_chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, chat_date, chat_time, chat_message, chat_pass_code', 'required'),
                        array('email, chat_pass_code', 'length', 'max'=>100),
                        array('profile_image_url', 'length', 'max'=>200),
			array('chat_message', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('chat_id, email, chat_date, chat_time, chat_message, chat_pass_code', 'safe', 'on'=>'search'),
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
			'chat_id' => 'Chat',
			'email' => 'Email',
			'chat_date' => 'Chat Date',
			'chat_time' => 'Chat Time',
			'chat_message' => 'Chat Message',
			'chat_pass_code' => 'Enter the chat code( Given by admin for chat )',
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

		$criteria->compare('chat_id',$this->chat_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('chat_date',$this->chat_date,true);
		$criteria->compare('chat_time',$this->chat_time,true);
		$criteria->compare('chat_message',$this->chat_message,true);
		$criteria->compare('chat_pass_code',$this->chat_pass_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_LiveChat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
