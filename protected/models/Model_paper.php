<?php

/**
 * This is the model class for table "tbl_paper".
 *
 * The followings are the available columns in table 'tbl_paper':
 * @property integer $paper_id
 * @property integer $author_id
 * @property integer $citation_id
 * @property string $paper_title
 * @property string $paper_field
 * @property string $paper_subject
 * @property string $issue_number
 * @property string $volume_number
 * @property string $paper_state
 * @property string $acceptance_date
 * @property string $paper_price
 * @property string $paper_abstract
 * @property string $paper_file
 * @property string $paper_file_pdf
 * The followings are the available model relations:
 * @property TblCitation $citation
 * @property TblAuthor $author
 */
class Model_paper extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $paper_file;
        public $paper_file_pdf;
        
	public function tableName()
	{
		return 'tbl_paper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.                [  paper_title, paper_field, paper_subject, issue_number, volume_number, paper_state, acceptance_date, paper_price, paper_abstract'
		return array(
			array('author_id, paper_title, paper_field, paper_subject, paper_abstract', 'required',),
			array('author_id, citation_id', 'numerical', 'integerOnly'=>true),
			array('paper_title', 'length', 'max'=>200),
			array('paper_field, paper_subject', 'length', 'max'=>100),
			array('issue_number, volume_number', 'length', 'max'=>50),
			array('paper_state', 'length', 'max'=>200),
			array('paper_price', 'length', 'max'=>10),
			array('paper_abstract', 'length', 'max'=>500),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('paper_id, author_id, citation_id, paper_title, paper_field, paper_subject, issue_number, volume_number, paper_state, acceptance_date, paper_price, paper_abstract', 'safe', 'on'=>'search'),
                        
                    );      
                return array(
                    array('paper_file, paper_file_pdf','file', 'types'=>'docx, doc, pdf','allowEmpty'=>true,'message'=>"docx,doc or pdf file only",'on'=>'update','safe'),
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
			'citation' => array(self::BELONGS_TO, 'Model_citation', 'citation_id'),
			'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paper_id' => 'Paper ID',
			'author_id' => 'Author ID',
			'citation_id' => 'Citation ID',
			'paper_title' => 'Paper Title',
			'paper_field' => 'Paper Field',
			'paper_subject' => 'Paper Subject',
			'issue_number' => 'Issue Number',
			'volume_number' => 'Volume Number',
			'paper_state' => 'Paper State',
			'acceptance_date' => 'Acceptance Date',
			'paper_price' => 'Paper Price',
			'paper_abstract' => 'Paper Abstract',
                        'paper_file'=>'Upload Paper (docx only)',
                        'paper_file_pdf'=>'PDF version',
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

		$criteria->compare('paper_id',$this->paper_id);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('citation_id',$this->citation_id);
		$criteria->compare('paper_title',$this->paper_title,true);
		$criteria->compare('paper_field',$this->paper_field,true);
		$criteria->compare('paper_subject',$this->paper_subject,true);
		$criteria->compare('issue_number',$this->issue_number,true);
		$criteria->compare('volume_number',$this->volume_number,true);
		$criteria->compare('paper_state',$this->paper_state,true);
		$criteria->compare('acceptance_date',$this->acceptance_date,true);
		$criteria->compare('paper_price',$this->paper_price,true);
		$criteria->compare('paper_abstract',$this->paper_abstract,true);

		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model_paper the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
