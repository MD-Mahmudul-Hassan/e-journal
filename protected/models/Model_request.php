<?php

/**
 * This is the model class for table "tbl_request".
 *
 * The followings are the available columns in table 'tbl_request':
 * @property integer $request_id
 * @property string $email
 * @property string $request_type
 * @property string $request_subject
 * @property string $request_message
 * @property string $request_approval
 *
 * The followings are the available model relations:
 * @property TblDirectPayment[] $tblDirectPayments
 * @property TblEmail $email0
 */
class Model_request extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $requested_paper_name,$requested_paper_issue_number;        
        public $_expert_field,$advertisement_text,$ad_image,$accepted_id,$chat_date,$chat_time,$chat_expert_editor;
        
    
	public function tableName()
	{
		return 'tbl_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, request_type, request_subject, request_message,', 'required'),
			array('email, request_subject', 'length', 'max'=>100),
			array('request_type, request_approval', 'length', 'max'=>200),
			array('request_message', 'length', 'max'=>500),
                        array('advertisement_text,ad_image','safe'),
                        array('chat_time,chat_date,chat_expert_editor','length','max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('request_id, email, request_type, request_subject, request_message, request_approval', 'safe', 'on'=>'search'),
		);
                return array(
                    array('ad_image,','file', 'types'=>'jpeg, png','allowEmpty'=>true,'message'=>"jpeg and png image only",'on'=>'update','safe','required'),
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
			'tblDirectPayments' => array(self::HAS_MANY, 'TblDirectPayment', 'request_id'),
			'email0' => array(self::BELONGS_TO, 'TblEmail', 'email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'request_id' => 'Request',
			'email' => 'Email',
			'request_type' => 'Request Type',
			'request_subject' => 'Looking for:',
			'request_message' => 'Request Message (500 characters)',
			'request_approval' => 'Request Approval',
                        'requested_paper_name'=>'Pass Code',
                        'requested_paper_issue_number'=>"Issue Number",
                        '_expert_field'=>'Looking for expert in:',
                        'advertisement_text'=>'Advertisement text (limit: 100 characters):',
                        'ad_image'=>'Upload your image (limit: 300px*150px):',
                        'accepted_id'=>'ID',
                        'chat_time'=>'Chat Time',
                        'chat_date'=>'Chat Date',
                        'chat_expert_editor'=>'Specialist Name',
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

		$criteria->compare('request_id',$this->request_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('request_type',$this->request_type,true);
		$criteria->compare('request_subject',$this->request_subject,true);
		$criteria->compare('request_message',$this->request_message,true);
		$criteria->compare('request_approval',$this->request_approval,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
