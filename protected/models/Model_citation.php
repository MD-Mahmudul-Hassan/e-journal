<?php

/**
 * This is the model class for table "tbl_citation".
 *
 * The followings are the available columns in table 'tbl_citation':
 * @property integer $citation_id
 * @property integer $viewed_abstract
 * @property integer $downloaded_full
 * @property integer $downloaded_abstract
 * @property integer $viewed_full
 *
 * The followings are the available model relations:
 * @property TblPaper[] $tblPapers
 */
class Model_citation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_citation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('viewed_abstract, downloaded_full, downloaded_abstract, viewed_full', 'required'),
			array('viewed_abstract, downloaded_full, downloaded_abstract, viewed_full', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('citation_id, viewed_abstract, downloaded_full, downloaded_abstract, viewed_full', 'safe', 'on'=>'search'),
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
			'tblPapers' => array(self::HAS_MANY, 'TblPaper', 'citation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'citation_id' => 'Citation',
			'viewed_abstract' => 'Viewed Abstract',
			'downloaded_full' => 'Downloaded Full',
			'downloaded_abstract' => 'Downloaded Abstract',
			'viewed_full' => 'Viewed Full',
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

		$criteria->compare('citation_id',$this->citation_id);
		$criteria->compare('viewed_abstract',$this->viewed_abstract);
		$criteria->compare('downloaded_full',$this->downloaded_full);
		$criteria->compare('downloaded_abstract',$this->downloaded_abstract);
		$criteria->compare('viewed_full',$this->viewed_full);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_citation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
