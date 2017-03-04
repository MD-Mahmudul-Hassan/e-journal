<?php

class RequestController extends Controller
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
                $data1=  Model_Email::model()->findAll("user_type='Admin'");
                $data2=  Model_Email::model()->findAll("user_type='Author'");                
                $admins=  CHtml::listData($data1, 'email', 'email');
                $authors= CHtml::listData($data2, 'email', 'email');
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','request_type_paper','request_final_submission','type_selector','request_type_advertisement','advertisement_final_submission','request_viewer_by_user','form_time'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete',),
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
	public function actionCreate($email)
	{
		$model=new Model_request;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $model->email=$email;
                
                $this->render('create',array('model'=>$model,));
               
	}
        
        public function actionType_selector()                
        {            
            $model=new Model_request;
            if(isset($_POST['Model_request']))
		{
			$model->attributes=$_POST['Model_request'];                                                
                        if($model->request_type==="paper")
                        {
                            $this->actionRequest_type_paper($model);                            
                        }
                        else if($model->request_type==="consultancy")
                        {
                            $this->actionRequest_type_consultancy($model);                  
                        }
                        else if($model->request_type==="advertisement")
                        {
                            $this->actionRequest_type_advertisement($model);                  
                        }
                        else 
                        {
                            Yii::app()->user->setFlash('error',"Select your request type!");
                            $this->actionCreate ();                        
                        }
                }
        }
        
        
        public function actionRequest_type_paper($model)
        {            
            $this->render('request_type_paper_selection_page',array('model'=>$model));        
        }
        public function actionRequest_type_consultancy($model)
        {            
            $this->render('request_type_consultancy',array('model'=>$model));        
        } 
        public function actionRequest_type_advertisement($model)
        {            
            $this->render('request_type_advertisement',array('model'=>$model));
        }
        
        
//------------------------------------FINAL SUBMISSION OF REQUEST---------------------------------------
        
        
        
        public function actionRequest_final_submission()
        {            
            $model=new Model_request;            
            if(isset($_POST['Model_request']))
            {         
                $model->attributes=$_POST['Model_request'];
                $model->ad_image=CUploadedFile::getInstance($model,'ad_image');                              
                $model->request_approval="Pending";                
                if($model->request_type==='paper')
                {
                    $model->request_message='No need'; 
                }
                if($model->save())
                {                  
                    Yii::app()->user->setFlash("success", "<strong>Thank you!</strong> Your request has been send successfully!<br>Keep patience for admin reply");
                    $model->unsetAttributes();
                }
                else
                {
                   Yii::app()->user->setFlash("error", "<strong>Sorry! </strong>Request could not be send! Please try again");   
                }                         
                $this->render('create',array("model"=>$model));                
            }        
        }
        
        public function actionAdvertisement_final_submission()
        {
            $model=new Model_request; 
            $filename;
            if(isset($_POST['Model_request']))
            {         
                $model->attributes=$_POST['Model_request'];
                $model->ad_image=CUploadedFile::getInstance($model,'ad_image');                              
                $model->request_approval="Pending";         
                $ad_text_len=  strlen($model->advertisement_text);
                if($model->ad_image===null)
                {
                    Yii::app()->user->setFlash("error", "<strong>No image selected to be uploaded! Please select an image</strong>");                    
                }
                else if($model->ad_image->getExtensionName()==='jpg'||$model->ad_image->getExtensionName()==='png')
                {           
                        $filename="{$model->email}______{$model->ad_image}";
                        $model->request_subject=$filename;
                        if($ad_text_len<=100)
                        {       
                                $model->request_message=$model->advertisement_text;
                                $model->ad_image->saveAs(Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$filename);
                                $image_size= getimagesize(Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$filename);
                                if(($image_size[0]===300)&&($image_size[1]===150))
                                {
                                    if($model->save())
                                    {
                                             $model->ad_image->saveAs(Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$filename); 
                                             Yii::app()->user->setFlash("success", "<strong>Advertisement request sent successfully!</strong>");
                                             $model->unsetAttributes();
                                    }
                                    else
                                    {
                                             Yii::app()->user->setFlash("error", "<strong>Advertisement info could not be saved!</strong>");
                                    }
                                }
                                else
                                {                            
                                    unlink(Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$filename);
                                    Yii::app()->user->setFlash("error", "<strong>Image size not match! Upload image with exact size. </strong>");
                                }
                        }
                        else
                        {
                            Yii::app()->user->setFlash("error", "<h4>Advertisement text is longer than 100 characters!</h4>");
                        }
                }                
                else
                {            
                    Yii::app()->user->setFlash("error", "<strong>Image type mismatch. Upload only jpeg or png images</strong>");
                }               
            }
       
            $this->render('create',array('model'=>$model));
            
        }
        
//----------------------------------------------------------------------------------------------------
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

		if(isset($_POST['Model_request']))
		{
			$model->attributes=$_POST['Model_request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->request_id));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Model_request');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,));
	}

	
	public function actionAdmin()
	{
		$model=new Model_request('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_request']))
			$model->attributes=$_GET['Model_request'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function loadModel($id)
	{
		$model=Model_request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model-request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        public function actionRequest_viewer_by_user($email)
        {
            $model2= new Model_request;
            
//            $dataprovider=new CActiveDataProvider('Model_request', 
//                 array(
//                    'criteria'=>array('condition'=>"paper_state='Paper Accepted'",'order'=>'paper_id DESC',),
//                    //'with'=>array('author'),
//                    'countCriteria'=>array('condition'=>"paper_state='Paper Accepted'",),
//                    'pagination'=>array('pageSize'=>5,),
//                     )  
//                ); 
            
            $sql="SELECT * from tbl_request Where email='$email' order by request_id desc";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $model=new CSqlDataProvider($sql,array('keyField' => 'request_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 10)));          
            $this->render('submitted_requests_viewer',array('model'=>$model,'model2'=>$model2));          
        }
        
        
        
        
        public function actionForm_time($id)
        {
            $model=  $this->loadModel($id);                        
            $models = Model_Editor::model()->findAll(); 
            $editors_list = CHtml::listData($models,'editor_last_name','editor_last_name');
            
            if(isset($_POST['Model_request']))
            {
                $model->attributes=$_POST['Model_request']; 
                
                $model->request_approval= "On ".$model->chat_date." at ".$model->chat_time." with Mr.".$model->chat_expert_editor;
                
                if($model->save())
                {                    
                    $this->redirect(CHtml::normalizeUrl(array('admin/user_request_monitor','_request_type'=>'consultancy')));                  
                }
                else
                {
                    
                    Yii::app()->user->setFlash('warning','<strong>Meeting could not be fixed.</strong>');
                }
            }
       
            $this->render('form_time_for_consultancy',array('model'=>$model,'editors_list'=>$editors_list));
        }        
                
         
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
