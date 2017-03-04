<?php

/**
 * This is the model class for table "tbl_author".
 *
 * The followings are the available columns in table 'tbl_author':
 * @property integer $author_id
 * @property string $author_first_name
 * @property string $author_last_name
 * @property string $email
 * @property string $author_since
 * The followings are the available model relations:
 * @property TblEmail $email0
 */
class Author extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_author';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        public $profile_image;
        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_first_name, author_last_name, email', 'required'),
                        array('profile_image', 'required','on'=>'authorpanel'),
			array('author_first_name, author_last_name, email', 'length', 'max'=>100),
                        array('author_since','length','max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('author_id, author_first_name, author_last_name, email', 'safe', 'on'=>'search'),
		);
                return array(
                        array('profile_image','image','types'=>'jpg, png'),
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
			'author_id' => 'Author',
			'author_first_name' => 'First Name',
			'author_last_name' => 'Last Name',
			'email' => 'Verify Email',
                        'author_since' => 'Author Since',
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

		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('author_first_name',$this->author_first_name,true);
		$criteria->compare('author_last_name',$this->author_last_name,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Author the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
