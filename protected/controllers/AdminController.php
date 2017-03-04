<?php

class AdminController extends Controller
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
               //$allowusers=array('hassan'=>'hassan','admin'=>'admin');                
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
				'actions'=>array('admin','delete','adminpanel','assigneditor','reviewer_monitor','user_request_monitor','accept_user_request','rejecting_user_request','consultancy_request_accept','meeting_fixer','final_chat_fix','Primary_paper_rejection_by_admin','Primary_paper_download_by_admin','Feedback_paper_download_by_admin'),
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
		$model=new Admin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Admin']))
		{
			$model->attributes=$_POST['Admin'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->admin_id));
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
		if(isset($_POST['Admin']))
		{
			$model->attributes=$_POST['Admin'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->admin_id));
		}
		$this->render('update',array('model'=>$model,));
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
		$dataProvider=new CActiveDataProvider('Admin');
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Admin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Admin']))
			$model->attributes=$_GET['Admin'];

		$this->render('admin',array('model'=>$model,));
	}

	public function loadModel($id)
	{
		$model=Admin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Admin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        

        
//--------------------------------admin panel---------------------------------------        
        
        
        
        
        
        public function actionAdminpanel($email)
	{           
            $model1=new Model_paper_editors;
            
            $model_email=new Model_Email;
            $profile_image_link=$this->get_user_profile_image_link($email);
            
            
            
            $connection= Yii::app()->db;                                        
            if(isset($_POST['Model_paper_editors']))
		{
                       $model1->attributes=$_POST['Model_paper_editors'];
                       $checking=$this->check_for_same_editor_assignment($model1->paper_id, $model1->editor_id);
                        
                        if($checking==="new_entry")                    
                        {                        
                            if($model1->save())
                            {
                                $update_id=$model1->paper_id;
                                $sql="Update tbl_paper SET paper_state='Editor has been assigned' Where paper_id=$update_id";
                                $command= $connection->createCommand($sql);           
                                $data=$command->execute();

                                Yii::app()->user->setFlash('success',"<strong>Reviewer has been assigned Successfully!</strong>");
                            }
                            else
                            {
                                Yii::app()->user->setFlash('error',"<strong>Reviewer could not be assigned! Try again</strong>");
                            }
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error',"<strong>This paper is already assinged to this Reviewer! Assign another Reviewer if you wish to.</strong>");
                        }
		}
            
           if(isset($_POST['Model_Email']))
                {                               
                       $model_email->attributes=$_POST['Model_Email'];              
                       $model_email->profile_image_holder=CUploadedFile::getInstance($model_email,'profile_image_holder');
                       if($model_email->profile_image_holder!==null)
                                if($model_email->profile_image_holder->getExtensionName()==='jpg' || $model_email->profile_image_holder->getExtensionName()==='png')
                                {
                                    $filename="{$email}_{$model_email->profile_image_holder}";
                                    Model_Email::model()->updateByPk($email, array('profile_image'=>$filename));
                                    $model_email->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename);
                                    Yii::app()->user->setFlash("success", "<h4>Profile Picture Changed</h4>");
                                    $this->refresh();
                                }
                                else
                                {
                                    //$model->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename);
                                     Yii::app()->user->setFlash("error", "<h4>Only jpg or png images are allowed</h4>");
                                }
                       else {
                            Yii::app()->user->setFlash("error", "<h4>You have not selected any image to update! Please Select an image.</h4>");        
                       }
                }     
                
                
                
                
                
            
            $sql="SELECT * FROM tbl_paper natural join tbl_author WHERE paper_state='Waiting for admin response'";        
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();            
            $model=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 20),
                'sort' => array(
                        'attributes' => array(
                            'paper_id',
                        ),
                        'defaultOrder' => array(
                            'paper_id' => CSort::SORT_ASC, //default sort value
                        ),
                    ),));    
       
            $this->render('admin_panel',array('model'=>$model,'model_email'=>$model_email,'profile_image'=>$profile_image_link));
  
	}
       
        
        public function check_for_same_editor_assignment($p_id,$e_id)
        {
            $sql="Select * from tbl_paper_editors where paper_id='$p_id' AND editor_id='$e_id'";
            $model=  Model_paper_editors::model()->findByAttributes(array('paper_id'=>$p_id,'editor_id'=>$e_id));
            if($model===null)
            {
                return "new_entry";
            }
            else return "duplicate_entry";
            
        }
           
        public function triggerModel($id)
	{
		$model=  Model_paper::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		else
                {
                
                }
	}
        
        
        public function actionReviewer_monitor()
	{
		$sql="SELECT * FROM tbl_paper natural join tbl_paper_editors natural join tbl_editor  WHERE paper_state='Editor has been assigned' OR paper_state='Corrected paper in process again' OR paper_state='Paper Reviewed. See the corrections and submit it again.'";        
                $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();            
                $model=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 20),
                'sort' => array(
                        'attributes' => array(
                            'paper_id',
                        ),
                        'defaultOrder' => array(
                            'p_e_id' => CSort::SORT_ASC, //default sort value
                        ),
                    ),));    
       
            $this->render('assigned_reviewer_list',array('model'=>$model));
	}
        
        
        public function actionUser_request_monitor($_request_type)
        {
            
            $counter1= $this->counting_request_types('paper');
            $counter2= $this->counting_request_types('consultancy');
            $counter3= $this->counting_request_types('advertisement');
            $dataProvider=new CActiveDataProvider('Model_request', 
                 array(
                    'criteria'=>array('condition'=>"request_type='$_request_type' && request_approval='Pending'",'order'=>'request_id DESC',),
                    //'with'=>array('author'),
                    'countCriteria'=>array('condition'=>"request_type='$_request_type' && request_approval='Pending'",),
                    'pagination'=>array('pageSize'=>5,),
                     )  
                );  
  
            $this->render('monitor_user_request_index',array('dataProvider'=>$dataProvider,'counter1'=>$counter1,'counter2'=>$counter2,'counter3'=>$counter3,'request_type'=>$_request_type));
        
        }
        
        public function counting_request_types($type)
        {
            $counter_type=0;
            $sql="SELECT COUNT(*) FROM tbl_request WHERE request_type='$type' && request_approval='Pending'";            
            $model=  Model_request::model()->countBySql($sql);
            return $model;            
        }
        
        public function actionAccept_user_request($request_id)
        {            
            $type_selected=$this->Request_type_selection_for_acceptance($request_id);            
            if($type_selected==='paper')
            {
                $this->actionPaper_request_accept($request_id);
            }
            else if($type_selected==='consultancy')
            {                    
                $this->actionConsultancy_request_accept($request_id);
            }
            else if($type_selected==='advertisement')
            {
                  $this->redirect(CHtml::normalizeUrl(array('options/option_main')));
            }
            else
            {             
                $this->actionUser_request_monitor('paper');
            }
   
        }
        
        public function actionRejecting_user_request($request_id) 
        {
            $counter1= $this->counting_request_types('paper');
            $counter2= $this->counting_request_types('consultancy');
            $counter3= $this->counting_request_types('advertisement');      
            $_request_type=$this->get_request_type_from_request_table($request_id);            
            $dataProvider=new CActiveDataProvider('Model_request', 
                 array(
                    'criteria'=>array('condition'=>"request_type='$_request_type' && request_approval='Pending'",'order'=>'request_id DESC',),
                    //'with'=>array('author'),
                    'countCriteria'=>array('condition'=>"request_type='$_request_type' && request_approval='Pending'",),
                    'pagination'=>array('pageSize'=>5,),
                     )  
                ); 
            
            $connection=  Yii::app()->db;
            $sql="UPDATE tbl_request set request_approval='Request Rejected' where request_id=$request_id";            
            $ready=$connection->createCommand($sql);
            if($ready->execute()!=null)
            {
                Yii::app()->user->setFlash('success',"<h3>Request no: $request_id has been rejected!</h3>"); 
                
            }
            else
            {
                    Yii::app()->user->setFlash('warning',"<h3>Request could not be rejected!</h3>");                
            }

             $this->render('monitor_user_request_index',array('dataProvider'=>$dataProvider,'counter1'=>$counter1,'counter2'=>$counter2,'counter3'=>$counter3,'request_type'=>$_request_type));         
           
            }
        
            
            public function get_request_type_from_request_table($id)
            {
                $type='paper';
                $sql="select * from tbl_request where request_id='$id'";
                
                $model=  Model_request::model()->findAllBySql($sql);
                $list=  CHtml::listData($model, 'request_type',' request_type');
                
                foreach ($list as $key => $value) {
                    $type=$key;
                }
                
                return $type;
                
            }
            
//========================================Consultancy Found=============================================
            
            
            
            
            
            
//===================================Finding Request Type for Accepting===================================       
        
        public function Request_type_selection_for_acceptance($request_id)
        {
            $target_type=null;
            $sql="Select * from tbl_request where request_id='$request_id'";
            $model=  Model_request::model()->findAllBySql($sql);            
            $list = CHtml::listData($model,'request_id', 'request_type');
            foreach ($list as $key => $value) 
            {
                $target_type=$value;
            }                
            return $target_type;      
        }
        
        public function actionPaper_request_accept($request_id) 
        {
            $connection=  Yii::app()->db;
            $secret_key=  mt_rand(10000000, 10000000000);
            $sql="UPDATE tbl_request set request_approval='$secret_key' where request_id=$request_id";            
            $ready=$connection->createCommand($sql);        
            if($ready->execute()!=null)
            {
                    Yii::app()->user->setFlash('success',"<h3>Request no: $request_id Accepted! A secret code has been send successfully.</h3>");                 
            }
            else
            {
                    Yii::app()->user->setFlash('warning',"<h3>Request could not be accepted!</h3>");                
            }
            
            $counter1= $this->counting_request_types('paper');
            $counter2= $this->counting_request_types('consultancy');
            $counter3= $this->counting_request_types('advertisement');
            $dataProvider=new CActiveDataProvider('Model_request', 
                 array(
                    'criteria'=>array('condition'=>"request_type='paper'",'order'=>'request_id DESC',),
                    //'with'=>array('author'),
                    'countCriteria'=>array('condition'=>"request_type='paper'",),
                    'pagination'=>array('pageSize'=>5,),
                     )  
                );
             $this->render('monitor_user_request_index',array('dataProvider'=>$dataProvider,'counter1'=>$counter1,'counter2'=>$counter2,'counter3'=>$counter3,));
            
            //$this->actionUser_request_monitor('paper');
            
            
        }
        
        
        
        public function actionConsultancy_request_accept($request_id) 
        {
            $model=  $this->loadRequestModel($request_id);
            $email=  $this->get_user_email_from_request($request_id);
            $models = Model_Editor::model()->findAll(); 
            $editors_list = CHtml::listData($models,'email','editor_last_name');
                       
            if(isset($_POST['Model_request']))
            {
                $model->attributes=$_POST['Model_request']; 
                $chat_code=rand(100000000, 1000000000);
                $result=$this->assigning_chat_code_to_user($chat_code, $email);
                $editors_name=$this->notify_expert_about_meeting_and_get_expert_name($model->chat_expert_editor,$model->chat_date,$model->chat_time);
                
                
                if($result==='chat code assigned')
                {       $model->request_approval= "On ".$model->chat_date." at ".$model->chat_time." with Mr.".$editors_name.". Your Chat Code is: ".$chat_code." Enter the code to pass the chat gate.";                
                        if($model->save())
                        {     
                            Yii::app()->user->setFlash('success','<h3>Meeting fixed successfully!</h3>');
                            $this->redirect(array('admin/user_request_monitor','_request_type'=>'consultancy'));                  
                        }
                        else
                        {
                            Yii::app()->user->setFlash('warning','<strong>Meeting could not be fixed.</strong>');
                        }
                }
                else
                {
                    Yii::app()->user->setFlash('error','<strong>Code could not be assigned.</strong>');
                }
            }
       
            
            $this->render('consultancy_time_fixer_page',array('model'=>$model,'editors_list'=>$editors_list));
                        
        }

//--------------------------------SUPPORTIVE FUNCTIONS---------------------------------        
        
        public function loadRequestModel($id)
	{
		$model=  Model_request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public function get_user_email_from_request($request_id) 
        {
            $email=null;
            $model=  Model_request::model()->findAllByPk($request_id);
            $list=  CHtml::listData($model, 'email','email');
            foreach ($list as $value) {
                $email=$value;
            }
            return $email;
            
        }

        public function assigning_chat_code_to_user($code,$email) 
        {
            $connection=  Yii::app()->db;
            $sql="UPDATE tbl_email SET user_chat_code='$code' WHERE email='$email'";
            $ready=$connection->createCommand($sql);
            if($ready->execute())
            {
                return "chat code assigned";
            }
            else
            {
                return "could not assign chat code";
            }
            
        }

        public function notify_expert_about_meeting_and_get_expert_name($email,$chat_date,$chat_time) 
        {
            date_default_timezone_set('Asia/Dhaka');        
            $currentDateTime=date('m/d/Y H:i:s');
            $currentTime = date('h:i A', strtotime($currentDateTime));
            $currentDate=date('d/m/Y', strtotime($currentDateTime));
            $date_time_merging=$currentDate." at ".$currentTime;
            
            
            
            $connection=  Yii::app()->db;
            $meeting_string="You have a live chat meeting on $chat_date at $chat_time. Please be online on time.";
            $sql="INSERT INTO tbl_notifications (notification_date,email,notification_message,notification_seen) VALUES ('$date_time_merging','$email','$meeting_string','Not seen yet')";
            $ready=$connection->createCommand($sql);
            $ready->execute();
            
            
            $editors_name=NULL;
            $model=  Model_Editor::model()->findAllByAttributes(array('email'=>$email));
            $list=  CHtml::listData($model, 'editor_last_name', 'editor_last_name');
            foreach ($list as $value) {
                $editors_name=$value;
            }
            
            return $editors_name;
            
            
        }
        
   
        
        public function get_user_profile_image_link($email) 
        {
            $image_name;
            $image_url=null;
            $model=  Model_Email::model()->findAllByPk($email);
            $list=  CHtml::listData($model,'profile_image', 'profile_image');
            foreach ($list as $value) {
                $image_name=$value;
            }
            
            $path=Yii::app()->basePath.'/profile_images/'.$image_name;
            $image_url=  Yii::app()->assetManager->publish($path);

            if($image_url===NULL)
            {
                return "Image not set";
            }
            else return $image_url;       
        }
        
 
        
        
        
//===============================SUPPORTIVE ACTIONS=======================================        
    
        
    public function actionPrimary_paper_download_by_admin($id)
        {   
            
            $sql="Select * from tbl_paper where paper_id=$id";            
            $model=Model_paper::model()->findAllBySql($sql);                        
            $list=CHtml::listData($model, 'paper_id', 'paper_title');
            
            $name=$list[$id];
               
            if($id===null)
            {
                Yii::app()->user->setFlash('error', "<h4>Paper name not defined!</h4>");
            }            
            else
            {
                    $src= Yii::app()->basePath."/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/$name";          
                    if(file_exists($src) && $name!=null)
                    {            
                        Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        Yii::app()->user->setFlash('success', "<h4>File Downloading..</h4>");
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', "<h4>The file is not found in the system!</h4>");
                    }
            }
           
            $this->redirect(CHtml::normalizeUrl(array('admin/adminPanel','email'=>  Yii::app()->user->name)));
          
        }    
        
        
        
        
    public function actionPrimary_paper_rejection_by_admin($id) 
    {
        $result=  Model_paper::model()->updateByPk($id, array('paper_state'=>'Paper has been rejected by Admin'));
        
        
        if(is_int($result))
        {
            Yii::app()->user->setFlash('success',"<h4>Paper no: $id has been rejected successfully!</h4>");
            
        }
        else
        {
            Yii::app()->user->setFlash('error',"<h4>Paper no: $id could not be rejected!</h4>");
        }   
       
        
        $this->redirect(CHtml::normalizeUrl(array('admin/adminPanel','email'=>  Yii::app()->user->name)));
        
    } 
        
        
        
    public function actionFeedback_paper_download_by_admin($id)
        {            
            $sql="Select * from tbl_paper where paper_id=$id";            
            $model=  Model_paper::model()->findAllBySql($sql);                        
            $list=  CHtml::listData($model, 'paper_id', 'paper_title');            
            $name=$list[$id];            
            if($name===null)
            {
                Yii::app()->user->setFlash('error', "<h4>Paper name not defined!</h4>");
            }            
            else
            {
                    $src= Yii::app()->basePath."/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/$name";          
                    if(file_exists($src) && $name!=null)
                    {            
                        Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        Yii::app()->user->setFlash('success', "File found! Downloading..");
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning', "<h4>The file is not reviewed yet.</h4>");
                    }
            }
           
             $this->redirect(CHtml::normalizeUrl(array('Reviewer_monitor')));
            
        }    
        
        
        
        
        
        
        
}
