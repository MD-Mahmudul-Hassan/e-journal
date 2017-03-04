<?php

class EmailController extends Controller
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
                              
                $admins=  CHtml::listData($data1, 'email', 'email');
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','register'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updatebyuser'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','register','updatebyuser','register_editor_by_admin'),
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
		$this->render('view',array('model'=>$this->loadModel($id),));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Model_Email;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_Email']))
		{
			$model->attributes=$_POST['Model_Email'];
                        
                        $model->password=  md5($model->password);
                        
                        
			if($model->save())
				$this->redirect(array('view','id'=>$model->email));
		}

		$this->render('create',array('model'=>$model,));
	}
    public function actionRegister()
	{
		$model=new Model_Email;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Model_Email']))
		{
			$model->attributes=$_POST['Model_Email'];
                        if($this->checkForDuplicateEntry($model->email)===Null)
                        {                            
                                $model->profile_image_holder=CUploadedFile::getInstance($model,'profile_image_holder'); 
                                if($model->profile_image_holder!==NULL && $model->password!==NULL)
                                {       if(($model->profile_image_holder->getExtensionName()==='jpg' || $model->profile_image_holder->getExtensionName()==='png'))
                                        {
                                                $rnd=rand(100000000, 1000000000);                                
                                                $filename="{$rnd}_{$model->profile_image_holder}";   
                                                $model->profile_image=$filename;
                                                $model->user_status="Offline";
                                                $model->user_chat_code="Not set";
//                                                if(isset($_POST['password']))
//                                                    { 
                                                
                                                $model->password=md5($model->password);                                                         
//                                                    }
                                                  

                                                        if($model->save())
                                                        {
                                                            $model->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename); 
                                                            if($model->user_type==='Author')
                                                            {
                                                                $this->redirect(CHtml::normalizeUrl(array('author/register_author')));
                                                            }
                                                            else if($model->user_type==='Editor')
                                                            {                                               
                                                                $this->redirect(CHtml::normalizeUrl(array('editor/register_editor')));
                                                            }
                                                            else if($model->user_type==='Visitor')
                                                            {
                                                                $this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'register_visitors_form')));
                                                            }
                                                        }
                                                        else
                                                        {
                                                             Yii::app()->user->setFlash('warning', "<h4>Data could not be saved! All the form fields must be filled up.</h4>");
                                                        }         
                                        }
                                        else
                                        {
                                             Yii::app()->user->setFlash('info', "<h4>Only jpeg or png images are allowed to upload.</h4>");
                                        }
                                       // $this->refresh();
                                }
                                else 
                                {
                                    Yii::app()->user->setFlash('warning', "<h4>You have not selected any profile picture</h4>");
                                }
                        }
			else
                        {   
                            Yii::app()->user->setFlash('warning', "<h4>This email is already registered to this system. Please try another email.</h4>");
                           // $this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'register_email')));
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

		if(isset($_POST['Model_Email']))
		{
			$model->attributes=$_POST['Model_Email'];
			$model->password=md5($model->password); 
			if($model->save())
				$this->redirect(array('view','id'=>$model->email));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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
		$dataProvider=new CActiveDataProvider('Model_Email');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_Email('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_Email']))
			$model->attributes=$_GET['Model_Email'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_Email the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_Email::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public function checkForDuplicateEntry($id)
	{
		$model=Model_Email::model()->findByPk($id);
		if($model===null)
                {
			return $model;
                }
                return $model;
		//else $this->renderPartial (CHtml::normalizeUrl(array('site/pages','view'=>'Registration')));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_Email $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--email-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
//----------------------------------updating user mail--------------------------
        public function actionUpdatebyuser($email)
	{
		$model=$this->loadModel($email);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_Email']))
		{
			$model->attributes=$_POST['Model_Email'];
			if($model->save())
                        {                            
                                Yii::app()->user->setFlash('success', '<h4>Profile Updated Successfully!</h4>');
				$this->redirect(array("email/updatebyuser",'email'=>$email));               
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error', '<h4>Profile Could not be Updated. Please Try again.</h4>');
                        }
		}
		$this->render('update_mail',array('model'=>$model,));
	}
        
        public function actionRegister_editor_by_admin()
        {
            $model= new Model_Email;
            
            
            
            $this->render('editor_registration_by_admin',array('model'=>$model));
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
//-----------------------------SUPPORTIVE FUNCTIONS-----------------------------
    public function cheak_email_for_double_entry($email) 
    {
        $model=Model_Email::model()->findByPk($email);
        if($model===NULL)
        {
            return "New email";
        }
        else return "Old email";
        
        
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
