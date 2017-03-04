<?php

class LivechatController extends Controller
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
				'actions'=>array('create','update','code_checking_gate','live_chat_panel','Clear_user_chat_history','Clear_all_chat_history','Iframe_testing'),
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
	public function actionCreate()
	{
		$model=new Model_LiveChat;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_LiveChat']))
		{
			$model->attributes=$_POST['Model_LiveChat'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->chat_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Model_LiveChat']))
		{
			$model->attributes=$_POST['Model_LiveChat'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->chat_id));
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
		$dataProvider=new CActiveDataProvider('Model_LiveChat');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_LiveChat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_LiveChat']))
			$model->attributes=$_GET['Model_LiveChat'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_LiveChat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_LiveChat::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_LiveChat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--live-chat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
//===================================CHAT MANAGER===========================================        
        
    public function actionCode_checking_gate($image_url)
    {
        $model=new Model_LiveChat;
        if(isset($_POST['Model_LiveChat']))
	{
            $model->attributes=$_POST['Model_LiveChat'];
            if($model->chat_pass_code==null)
            {
                Yii::app()->user->setFlash('error',"<h4>You have submitted an empty code! Please submit the code given by admin to enter the live chat.</h4>");
            }    
            else    
            {    
                $result=$this->verify_chat_code($model->chat_pass_code,  Yii::app()->user->name);
                if($result==='code found')
                {
                    Yii::app()->user->setFlash('success','Code Verified Successfully! Welcome to live consultancy panel.');
                    $this->redirect(array('livechat/live_chat_panel','image_url'=>$image_url,'chat_code'=>$model->chat_pass_code));
                }
                else 
                {
                    Yii::app()->user->setFlash('error',"Code didn't match!");

                }
//                Yii::app()->user->setFlash('success',"chat code=$model->chat_pass_code")   ;
            }
            
                                
	}
             
        $this->render('code_checking_gate',array('model'=>$model));
           
    }
        
    public function verify_chat_code($key,$email) 
    {
        $model=Model_email::model()->findByAttributes(array('user_chat_code'=>$key,'email'=>$email));
        if($model!=NULL)
        {
            return "code found";
        }
        else return "code not found";    
    }
    
    public function actionLive_chat_panel($image_url)
    {
        $model=new Model_LiveChat;
        
        
        $email=  Yii::app()->user->name;        
        $chat_code=$this->get_chat_code_of_the_current_user($email);
        date_default_timezone_set('Asia/Dhaka');        
        $currentDateTime=date('m/d/Y H:i:s');
        $currentTime = date('h:i A', strtotime($currentDateTime));
        $currentDate=date('Y-m-d', strtotime($currentDateTime));        
        if(isset($_POST['Model_LiveChat']))
	{
            
                
                
                $model->attributes=$_POST['Model_LiveChat'];
                
                //$this->performAjaxValidation($model);
                
                $model->email=$email;
                $model->chat_date=$currentDate;
                $model->chat_time=$currentTime;
                $model->chat_pass_code=$chat_code;  
                $model->profile_image_url=$image_url;
                if($model->save())
                {                       
                    $this->refresh();
                    $this->redirect(array('live_chat_panel','image_url'=>$image_url));            
                }
                 
        }
        $dataprovider=new CActiveDataProvider('Model_LiveChat', 
                    array(
                    'criteria'=>array
                        (   //'with'=>array('email0'),
                            'condition'=>"chat_pass_code='$chat_code'",
                            //'join' => 'JOIN tbl_email em ON em.email=t.email',
                            'order'=>'chat_id asc',
                        ),                    
                    //'countCriteria'=>array('condition'=>"chat_pass_code='$chat_code'",),
                    //'pagination'=>array('pageSize'=>5,),
                     )  
                    ); 
        
//            $sql="SELECT * from tbl_live_chat NATURAL JOIN tbl_email Where chat_pass_code='$chat_code' ORDER BY chat_id desc";
//            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
//            $dataprovider=new CSqlDataProvider($sql,array('keyField' => 'chat_id','totalItemCount' => $count,));
//            
        $this->render('live_chat_index',array('dataProvider'=>$dataprovider,'model'=>$model,'image_url'=>$image_url,'chat_code'=>$chat_code));
    }
        
        
    
    public function actionIframe_testing()
    {
        //live_chat_render_partial
        $this->renderPartial('iframe_testing_for_chat');
    }
    
    
//--------------------------------------SUPPORTIVE FUNCTIONS--------------------------------------    
    
    
    public function get_chat_code_of_the_current_user($email) 
    {
        $chat_code=null;
        $model=  Model_Email::model()->findAllByPk($email);
        $list=  CHtml::listData($model, 'user_chat_code','user_chat_code');
        foreach ($list as $value) {
            $chat_code=$value;
        }        
        return $chat_code;
   
    }
        
//-----------------------------CLEARING CHAT DATA-------------------------------
    public function actionClear_user_chat_history($image_url)
    {
        $chat_code=  $this->get_chat_code_of_the_current_user(Yii::app()->user->name);
        $result=  Model_LiveChat::model()->deleteAllByAttributes(array('email'=>  Yii::app()->user->name,'chat_pass_code'=>$chat_code));
        
        if($result!=null)
        {
            Yii::app()->user->setFlash('success','<h4>Your comments are removed Successfully!</h4>');
            $this->redirect(array('live_chat_panel','image_url'=>$image_url));
        }
        else
        {
            Yii::app()->user->setFlash('warning','<h4>History might already been cleared or could not be cleared. Please Try again.</h4>');
            $this->redirect(array('live_chat_panel','image_url'=>$image_url));
        }
        
    }
    public function actionClear_all_chat_history($image_url)
    {
        $chat_code=  $this->get_chat_code_of_the_current_user(Yii::app()->user->name);
        $result=  Model_LiveChat::model()->deleteAllByAttributes(array('chat_pass_code'=>$chat_code));
        
        if($result!=null)
        {
            Yii::app()->user->setFlash('success','<h4>All History Cleared Successfully!</h4>');
            $this->redirect(array('live_chat_panel','image_url'=>$image_url));
        }
        else
        {
            Yii::app()->user->setFlash('warning','<h4>History might already been cleared or could not be cleared. Please Try again.</h4>');
            $this->redirect(array('live_chat_panel','image_url'=>$image_url));
        }
        
    }    
        
        
        
        
    protected function performAjax($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--live-chat-form')
		{
			//echo CActiveForm::validate($model);
			//Yii::app()->end();
                    
                        
                    
                    
		}
	}    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
