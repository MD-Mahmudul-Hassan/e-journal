<?php

/**
 * This is the model class for table "tbl_email".
 *
 * The followings are the available columns in table 'tbl_email':
 * @property string $email
 * @property string $password
 * @property string $user_type
 * @property string $contact_no
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $institution_name
 * @property string $secret_question
 * @property string $secret_answer
 * @property string $profile_image
 * @property string $user_status
 * @property string $user_chat_code
 * 
 * The followings are the available model relations:
 * @property TblAdmin[] $tblAdmins
 * @property TblAuthor[] $tblAuthors
 * @property TblEditor[] $tblEditors
 * @property TblRegisteredVisitors[] $tblRegisteredVisitors
 */
class Model_Email extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $profile_image_holder;
        public function tableName()
	{
		return 'tbl_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.   profile_image_holder
		return array(
			array('email, password,user_type, contact_no, address, city, country, institution_name, secret_question, secret_answer,', 'required'), 
			array('email, city, country', 'length', 'max'=>100),
			array('password, secret_question, secret_answer', 'length', 'max'=>300),
			array('user_type, contact_no', 'length', 'max'=>50),
			array('address, institution_name', 'length', 'max'=>200),
                        array('user_status, user_chat_code', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('email, password, user_type, contact_no, address, city, country, institution_name, secret_question, secret_answer', 'safe', 'on'=>'search'),
		);
                return array(
                        array('profile_image_holder','image','types'=>'jpg, png'),
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
			'tblAdmins' => array(self::HAS_MANY, 'TblAdmin', 'email'),
			'tblAuthors' => array(self::HAS_MANY, 'TblAuthor', 'email'),
			'tblEditors' => array(self::HAS_MANY, 'TblEditor', 'email'),
			'tblRegisteredVisitors' => array(self::HAS_MANY, 'TblRegisteredVisitors', 'email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'email' => 'Email',
			'password' => 'Password',
			'user_type' => 'User Type',
			'contact_no' => 'Contact No',
			'address' => 'Address',
			'city' => 'City',
			'country' => 'Country',
			'institution_name' => 'Institution Name',
			'secret_question' => 'Secret Question',
			'secret_answer' => 'Secret Answer',
                        'profile_image_holder'=>'Select your profile picture',
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

		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('contact_no',$this->contact_no,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('institution_name',$this->institution_name,true);
		$criteria->compare('secret_question',$this->secret_question,true);
		$criteria->compare('secret_answer',$this->secret_answer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_Email the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function showphoto_from_database()
        { 
     
            $model=Model_Email::model()->findAllByPk('hassan@mail.com');
            $list=CHtml::listData($model, 'email', 'profile_image');
            foreach ($list as $key => $value) {
                    $imageData= $value;
            }
            //echo $imageData;
            $img="data:image/jpeg;base64,".$imageData;
           return CHtml::image($img,'No Image',array('width'=>150,'height'=>100));
    
        }
        
        
}
