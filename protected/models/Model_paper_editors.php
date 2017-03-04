<?php

/**
 * This is the model class for table "tbl_paper_editors".
 *
 * The followings are the available columns in table 'tbl_paper_editors':
 * @property integer $p_e_id
 * @property integer $paper_id
 * @property integer $editor_id
 *
 * The followings are the available model relations:
 * @property TblEditor $editor
 * @property TblPaper $paper
 */
class Model_paper_editors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $editor_name;
	public function tableName()
	{
		return 'tbl_paper_editors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paper_id, editor_id', 'required'),
			array('paper_id, editor_id', 'numerical', 'integerOnly'=>true),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('p_e_id, paper_id, editor_id,', 'safe', 'on'=>'search'),
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
			'editor' => array(self::BELONGS_TO, 'TblEditor', 'editor_id'),
			'paper' => array(self::BELONGS_TO, 'TblPaper', 'paper_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'p_e_id' => 'P E',
			'paper_id' => 'Paper ID',
			'editor_id' => 'Editor ID',
                        'editor_name'=>'Editor name'
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

		$criteria->compare('p_e_id',$this->p_e_id);
		$criteria->compare('paper_id',$this->paper_id);
		$criteria->compare('editor_id',$this->editor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_paper_editors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
