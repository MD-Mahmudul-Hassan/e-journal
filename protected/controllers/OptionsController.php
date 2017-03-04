<?php

class OptionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
                $data=  Model_Email::model()->findAll("user_type='Admin'");
                $admins=  CHtml::listData($data, 'email', 'email');
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','option_main'),
				'users'=>$admins,
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Model_options;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_options']))
		{
			$model->attributes=$_POST['Model_options'];
			if($model->save())
                        {
                            $this->redirect(array('view','id'=>$model->option_id));
                        }
				
		}

		$this->render('create',array('model'=>$model,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Model_options']))
		{
			$model->attributes=$_POST['Model_options'];
                        
                        if($model->option_target==='Not needed')
                        {
                            $this->ad_reseting($id);
                        }
                        else
                        {                               
                            $get_text=$this->get_ad_text($model->option_target);
                            $model->option_details=$get_text;

                            if($model->save())
                            {                                             
                                $update_ad_row=$this->Updating_advertisement_request($model->option_target);
                                Yii::app()->user->setFlash('success', '<h4>Settings Saved successfully!</h4>');
                                $this->redirect(array('option_main'));                                        
                                     
                            }
                            else
                            {
                                        Yii::app()->user->setFlash('warning', '<h4>Advertisement already set or update might not be required</h4>');                            
                                        $this->redirect(array('option_main'));
                            }
                        }       
                 }
                 $this->redirect(array('option_main'));
		//$this->render('update',array('model'=>$model,));
	}
        
        public function Updating_advertisement_request($id)
        {
            $connection=  Yii::app()->db;
            $sql="UPDATE tbl_request set request_approval='Accepted' where request_subject='$id'";
            $ready=$connection->createCommand($sql);            
            if($ready->execute())
            {            
                return "success";
            }
            else 
            {
                return "failed";
            }           
        }
        
        public function get_ad_text($id)
        {
            $text=null;
            $sql="SELECT * FROM tbl_request where request_subject='$id'";
            $model=  Model_request::model()->findAllBySql($sql);
            
            $data=  CHtml::listData($model, 'request_message', 'request_message');
            
            foreach ($data as $value) {
                $text=$value;
            }
            
            if($text!=null)
            {
                return $text;
            }
            else return "no text found";
            
        }

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Model_options');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_options('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_options']))
			$model->attributes=$_GET['Model_options'];

		$this->render('admin',array('model'=>$model,));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_options the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_options::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_options $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model-options-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
//--------------------------------------OPTIONS MAIN PAGE---------------------------------------
        
        
        
        public function actionOption_main()
        {
            //$dataProvider=new CActiveDataProvider('Model_options');
            //$this->render('options_main_page_index',array('dataProvider'=>$dataProvider,));
             $option1= $this->loading_all_options_as_models('10');
             $option2= $this->loading_all_options_as_models('11');
             $option3= $this->loading_all_options_as_models('12');
             $option4= $this->loading_all_options_as_models('13');
             $option5= $this->loading_all_options_as_models('14');
             $ad_name_list=$this->loading_list_of_ads();
 
             $this->render('options_main_page', array('model1'=>$option1,'model2'=>$option2,'model3'=>$option3,'ad_list'=>$ad_name_list,'model4'=>$option4,'model5'=>$option5));
                 
        }
        
        public function loading_all_options_as_models($id) 
        {
                $model=Model_options::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                return $model;            
        }
        
        public function loading_list_of_ads()
        {
            $sql="SELECT * FROM tbl_request WHERE request_type='advertisement'";
            $model=  Model_request::model()->findAllBySql($sql);            
            $list_of_ads=  CHtml::listData($model, 'request_subject', 'request_subject');            
            return $list_of_ads;            
        }
        
        
        
        
//=============================SUPPORTIVE FUNCTIONS================================
        
     public function ad_reseting($id) 
     {
         $result=Model_options::model()->updateByPk($id,array('option_target'=>'Not needed.jpg','option_details'=>'','option_link'=>''));
         
         if(is_int($result))
         {
             Yii::app()->user->setFlash('success',"<h4>Settings Saved Successfully!</h4>");
         }
         else
         {
             Yii::app()->user->setFlash('error',"Settings could not be saved. Try again.");
         }
         
     }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
