<?php

/**
 * This is the model class for table "tbl_options".
 *
 * The followings are the available columns in table 'tbl_options':
 * @property integer $option_id
 * @property string $option_action_name
 * @property string $option_action_state
 * @property string $option_target
 * @property string $option_details
 * @property string $option_link
 */

class Model_options extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_action_name, option_action_state, option_target,option_details, option_link', 'required'),
			array('option_action_name, option_action_state', 'length', 'max'=>100),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('option_id, option_action_name, option_action_state', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'option_id' => 'Option',
			'option_action_name' => 'Option Action Name',
			'option_action_state' => 'Option Action State',
                        'option_target'=>'Select Advertisement Image:',
                        'option_details'=>'Details:',
                        'option_link'=>'Link',
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

		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('option_action_name',$this->option_action_name,true);
		$criteria->compare('option_action_state',$this->option_action_state,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_options the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
