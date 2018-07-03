<?php

class EditorController extends Controller
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
                $data2=  Model_Email::model()->findAll("user_type='Editor'");                
                $admins=  CHtml::listData($data1, 'email', 'email');
                $editors= CHtml::listData($data2, 'email', 'email');
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','register_editor'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','register_editor','editorspanel','accept_paper','updatebyeditor','downloadpaperaspdf_by_editor','publish_a_paper','editor_notifications','notification_seen'),
				'users'=>$editors,
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','register_editor','editorspanel','accept_paper','updatebyeditor'),
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
		$model=new Model_Editor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_Editor']))
		{
			$model->attributes=$_POST['Model_Editor'];
                        if($this->checkForDuplicateEntry($model->email)==='valid')
                        {
                                if($model->save())
				$this->redirect(array('view','id'=>$model->editor_id));
                        }
                        else $this->redirect(CHtml::normalizeUrl(array('editor/create')));
		}

		$this->render('create',array('model'=>$model,));
	}
        
        public function actionRegister_editor()
        {
                $model=new Model_Editor;
                date_default_timezone_set('Asia/Dhaka');        
                $currentDateTime=date('m/d/Y H:i:s');               
                $currentDate=date('d-m-Y', strtotime($currentDateTime));
                if(isset($_POST['Model_Editor']))
                {
                    $model->attributes=$_POST['Model_Editor'];
                    $model->editor_since=$currentDate;
                    if($this->checkForDuplicateEntry($model->email)==='valid')
                    {   if($model->validate())
                        {                    
                            $model->save();
                             $this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'success_page')));
                        }
                    }
                    else  
                    {   
                        Yii::app()->user->setFlash('error',"<h4>Your current email didn't match the previous one. Please enter your email correctly.</h4>");
                
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

		if(isset($_POST['Model_Editor']))
		{
			$model->attributes=$_POST['Model_Editor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->editor_id));
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
		$dataProvider=new CActiveDataProvider('Model_Editor');
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_Editor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_Editor']))
			$model->attributes=$_GET['Model_Editor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_Editor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_Editor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public function checkForDuplicateEntry($id)
	{
                $sql="SELECT * FROM tbl_editor WHERE email='$id'";
                
                $model = Model_Editor::model()->findBySql($sql);                
                if($model===NULL)     //  if Email is not used by other Editors
                {
                    $model2= Model_Email::model()->findByPk($id);
                    if($model2!=NULL)  // Email found in tbl_email
                    {
                        return 'valid';                       
                        
                    }
                    else return 'invalid';                 
                }
                else   // if email is already used by another editor  
                    return 'invalid';
                
		//else $this->renderPartial (CHtml::normalizeUrl(array('site/pages','view'=>'Registration')));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_Editor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--editor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        
//-------------------------------------EDITORS PANEL------------------------------------------------        
        
        
        
        public function actionEditorspanel($email)
	{
            $model_email=new Model_Email;
            $editor_data=$this->get_editors_id_by_email($email);
            
            $editor_id=$editor_data['editor_id'];
            $editors_full_name=$editor_data['editor_full_name'];
            $editor_since=$editor_data['editor_since'];
            $profile_image_link=$this->get_user_profile_image_link($email);
            
            $sql="SELECT * from tbl_paper_editors NATURAL JOIN tbl_paper Where editor_id='$editor_id' AND paper_state!='Congratulation! Paper has been published successfully!' ORDER BY p_e_id desc";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $model=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 5)));          
                      
            $counting_notifications=  Model_notifications::model()->countByAttributes(array('email'=>$email,'notification_seen'=>'Not seen yet'));
     
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
  
            $this->render('editors_panel',array('model'=>$model,'model_email'=>$model_email,'profile_image'=>$profile_image_link,'editors_full_name'=>$editors_full_name,'counting_notifications'=>$counting_notifications,'editor_since'=>$editor_since));
	}
        
        
        public function get_editors_id_by_email($email) {
            $editors_id=null;
            $editors_full_name=null;
            $editor_since;
            $model= Model_Editor::model()->findAllByAttributes(array('email'=>$email));
            $list= CHtml::listData($model, 'editor_id', 'editor_since');
            $list2= CHtml::listData($model, 'editor_first_name', 'editor_last_name');
                       
            foreach ($list as $key=>$value) {
                $editors_id=$key;
                $editor_since=$value;
              
            }
            foreach ($list2 as $key=>$value) {
                $editors_full_name=$key." ".$value;
            }
            $editor_data=array('editor_id'=>$editors_id,'editor_full_name'=>$editors_full_name,'editor_since'=>$editor_since);
            return $editor_data;                        
        }
        
        
        
        public function actionAccept_paper()
        {
            $model=new Model_paper;
            $connection= Yii::app()->db;
            
            if(isset($_POST['Model_paper']))
            {
                $model->attributes=$_POST['Model_paper'];
                $model->paper_file=CUploadedFile::getInstance($model,'paper_file');                
                if($model->paper_file===NULL)
                {                    
                        Yii::app()->user->setFlash('error', "File is missing! Please choose a file and try again.");                       
                }
                else if(($model->paper_file->getExtensionName()==="docx"))
                {
                        $paper_name=$model->paper_file->getName();                
                        $model->paper_state="Paper Accepted! Please upload the final copy of the paper in both doc and pdf format.";
                        $sql="UPDATE tbl_paper SET paper_state='$model->paper_state' WHERE paper_title like '%$paper_name%'";   
                        $command=$connection->createCommand($sql);                
                        if($command->execute())
                        {
                            $model->paper_file->saveAs(Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS1/j#1%!23JqZdru%@_3349kp/'.$model->paper_file);
                            Yii::app()->user->setFlash('success', "Paper Accepted Successfully!!");
                        }                        
                        else {         
                            Yii::app()->user->setFlash('warning', "Operation already done!");
                        }
                }
                else
                {
                        Yii::app()->user->setFlash('error', "File type mismatch! Please upload only doc or docx file.");                                   
                }               
            }            
            $this->render('accept_paper_form',array('model'=>$model,));
            
            
        }
        
        
        public function actionDownloadpaperaspdf_by_editor($paper_title)
        {   
            $dataprovider= new CActiveDataProvider('Model_paper'); 
                        
            $len= strlen($paper_title);            
            $cut1=substr($paper_title, 0, $len-5);               
            $pdf="pdf";
            $cut2="{$cut1}.{$pdf}";            
            $name=$cut2;            
            if($name===null)
            {
                Yii::app()->user->setFlash('error', "Paper name not defined!");
            }            
            else
            {
                    $checking_paper_status=$this->check_papers_current_status_for_next_action_for_pdf($paper_title);                
                    if($checking_paper_status==='Author has submitted the final copy of the paper in both format.')
                    {
                        $src=Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS1/j#1%!23JqZdru%@_3349kp/accepted_pdf_versions/'.$name;
                        if(file_exists($src) && $name!=null)
                        {            
                            Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                            //Yii::app()->user->setFlash('success', "File found! Downloading..");
                        }
                        else
                        {    
                            $this->trying_to_find_pdf_of_doc_to_download($paper_title);
                            
                        }
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', "<h4>The PDF version of this paper has not been submitted by its author yet. PDF version will be available after author's final submission.</h4>");
                    }
                    
            }
           $this->redirect(CHtml::normalizeUrl(array('editor/editorspanel','email'=>  Yii::app()->user->name)));
            //$this->render("download_index_page",array("dataProvider"=>$dataprovider));                   
        }
        
        
        public function actionPublish_a_paper($paper_id)
        {
            
            $checking_paper_status=$this->check_papers_current_status_for_publication($paper_id);
            if($checking_paper_status==='Author has submitted the final copy of the paper in both format.')
            {            
                $publishing_result=  $this->update_paper_state_volume_and_issue_number_($paper_id);
                if($publishing_result==='Successfully Published')
                {
                    Yii::app()->user->setFlash('success', '<h4>Paper has been published successfully! Thank you for your valuable time.</h4>');
                }
                else
                {
                     Yii::app()->user->setFlash('error', '<h4>Paper could not be published. Please try again.</h4>');
                }
            
            }
            else
            {
                    Yii::app()->user->setFlash('warning', '<h4>You can only publish those papers which are finally submitted by its authors.<h4>');
            }
            
            $this->redirect(CHtml::normalizeUrl(array('editor/editorspanel','email'=>  Yii::app()->user->name)));
        }

        public function actionEditor_notifications($email)
        {   
            $sql="SELECT * from tbl_notifications Where email='$email' ORDER BY notification_id DESC";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $model=new CSqlDataProvider($sql,array('keyField' => 'notification_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 10)));     
            $this->render('editors_notifications',array('model'=>$model));
       
        }
        
        public function actionNotification_seen($id)
        {            
            $result=Model_notifications::model()->updateByPk($id, array('notification_seen'=>'Yes'));           
            if(is_int($result))
            {
                Yii::app()->user->setFlash('success', "<h4>Notification Seen</h4>");
            }
            else
            {
                Yii::app()->user->setFlash('error', "<h4>Could not be updated as seen</h4>");
            }
            $this->actionEditor_notifications(Yii::app()->user->name);            
        }


























//====================================UPDATE BY EDITOR======================================
 
        
        public function actionUpdatebyeditor($email)
        {
            $id=$this->get_editors_id_by_email($email);
            
            $model=$this->loadModel($id);            
            if(isset($_POST['Model_Editor']))
		{
			$model->attributes=$_POST['Model_Editor'];
			if($model->save())
                        {
                            Yii::app()->user->setFlash('success', '<h4>General Profile Updated Successfully!</h4>');
                            $this->redirect(array('updatebyeditor','email'=>$email));                      
                        }
                        else Yii::app()->user->setFlash('error', '<h4>Could not be Updated! Please try again.</h4>');
		}

            $this->render('update_by_editor',array('model'=>$model,));
        
            
        }
        
        
//-----------------------------------SUPPORTIVE FUNCTIONS------------------------------------
        
        
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
        
        
        public function trying_to_find_pdf_of_doc_to_download($paper_title) 
        {
            $len= strlen($paper_title);            
            $cut1=substr($paper_title, 0, $len-4);               
            $pdf="pdf";
            $cut2="{$cut1}.{$pdf}";            
            $name=$cut2;            
            $src= Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS1/j#1%!23JqZdru%@_3349kp/accepted_pdf_versions/'.$name;                             
            if(file_exists($src) && $name!=null)
            {            
                Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                Yii::app()->user->setFlash('success', "File found for doc! Downloading..");
            }
            else
            {
                Yii::app()->user->setFlash('error', "<h4>The pdf version of this paper is not yet submitted by its author.<h4>");
            }

            
        }
        
        
        public function check_papers_current_status_for_next_action_for_pdf($paper_title) 
        {
            $result=null;            
            $connection=Yii::app()->db; 
            $sql="SELECT * from tbl_paper WHERE paper_title like '%$paper_title%'";
            $ready=$connection->createCommand($sql);
            $data=$ready->queryAll();            
            $list=  CHtml::listData($data, "paper_title", "paper_state");            
            foreach ($list as $key => $value) {
                $result=$value;
            }
                      
            if($result===Null)
            {
                return "State not found";
            }
            else
            {
                return $result;
            }
                        
        }
        
        public function check_papers_current_status_for_publication($paper_id) 
        {
            $result=null;
            $result=  Model_paper::model()->findAllByPk($paper_id);
            $list=  CHtml::listData($result, "paper_title", "paper_state");            
            foreach ($list as $key => $value) {
                $result=$value;
            }              
            if($result===Null)
            {
                return "State not found";
            }
            else
            {
                return $result;
            }
                        
        }
        
        public function update_paper_state_volume_and_issue_number_($paper_id) 
        {
            $volume_number;
            $issue_number;
   
            
            $data1=Model_options::model()->findAllByPk('13');
            $data2=Model_options::model()->findAllByPk('14');
                    
            $list1= CHtml::listData($data1, 'option_target', 'option_target');
            $list2= CHtml::listData($data2, 'option_target', 'option_target');
            
            date_default_timezone_set('Asia/Dhaka');        
            $currentDateTime=date('m/d/Y H:i:s');
            //$currentTime = date('h:i A', strtotime($currentDateTime));
            $currentDate=date('Y-m-d', strtotime($currentDateTime)); 
            
            
            foreach ($list1 as $value) {
                $volume_number=$value;
            }
            foreach ($list2 as $value) {
                $issue_number=$value;
            }
            
            $updating_volume=  Model_paper::model()->updateByPk($paper_id, array('volume_number'=>$volume_number));
            $updating_issue=  Model_paper::model()->updateByPk($paper_id, array('issue_number'=>$issue_number));
            $updating_paper_state=  Model_paper::model()->updateByPk($paper_id, array('paper_state'=>'Congratulation! Paper has been published successfully!'));
            $updating_published_date=  Model_paper::model()->updateByPk($paper_id, array('acceptance_date'=>$currentDate));
            
            
            if(is_int($updating_paper_state))
            {
                if(is_int($updating_volume))
                {
                    if(is_int($updating_issue))
                    {
                        if(is_int($updating_published_date))
                        {
                             return "Successfully Published";
                        }
                        else
                        {                
                            return "failed";
                        }
                    }
                    else
                    {                
                        return "failed";
                    }
                }
                else
                {                
                    return "failed";
                }
            }
            else
            {                
                return "failed";
            }
            
            
      
        }
        
        
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
