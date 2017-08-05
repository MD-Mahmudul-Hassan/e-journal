<?php

class AuthorController extends Controller
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
				'actions'=>array('index','view','register_author'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow Admins to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','register_author','authorpanel','paperuploader','paperstatus','updatebyauthor'),
				'users'=>$admins,
			),
                        array('allow', // allow Admins to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','register_author','authorpanel','paperuploader','paperstatus','updatebyauthor','image_uploading','displaySavedImage','profile_image_update','author_notifications','notification_seen'),
				'users'=>$authors,
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
		$model=new Author;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Author']))
		{
			$model->attributes=$_POST['Author'];
			if($this->checkForDuplicateEntry($model->email)==='valid')
                            {
                                if($model->save())
                                        $this->redirect(array('view','id'=>$model->author_id));
                            }
                        else $this->redirect(CHtml::normalizeUrl(array('author/create')));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        public function actionRegister_author()
        {
                $model=new Author;
                // uncomment the following code to enable ajax-based validation                
//                if(isset($_POST['ajax']) && $_POST['ajax']==='author-register_author_form-form')
//                {
//                    echo CActiveForm::validate($model);
//                    Yii::app()->end();
//                }
                
                date_default_timezone_set('Asia/Dhaka');        
                $currentDateTime=date('m/d/Y H:i:s');               
                $currentDate=date('d-m-Y', strtotime($currentDateTime));
                if(isset($_POST['Author']))
                {
                    
                    $model->attributes=$_POST['Author'];
                    
                    $model->author_since=$currentDate;
                    if($this->checkForDuplicateEntry($model->email)==='valid')
                        {
                            if($model->validate())
                            {
                                $model->save();
                                $this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'success_page')));
                            }
                        }
                     else
                     {
                         Yii::app()->user->setFlash('error',"<h4>Your current email didn't match the previous one. Please enter your email correctly.</h4>");
                         //$this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'register_author_form')));
                
                     }    
                 }
                $this->render('register_author_form',array('model'=>$model));
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

		if(isset($_POST['Author']))
		{
			$model->attributes=$_POST['Author'];
                        if($model->validate())
                        {
                                $model->save();
				$this->redirect(CHtml::normalizeUrl(array('/admin/adminpanel')));
                        }
		}

		$this->render('update',array('model'=>$model,));    //passing model data to the 'update' page
	}
        
//-------------------------Update Panel for author---------------------------------------------------------
        
        
        
        
        
        
        
        
//---------------------------------------------------------------------------------------------------------        
        

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
		$dataProvider=new CActiveDataProvider('Author');
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Author('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Author']))
			$model->attributes=$_GET['Author'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	 
	public function loadModel($id)
	{
		$model=Author::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        
         public function checkForDuplicateEntry($id)
	{
                $sql="SELECT * FROM tbl_author WHERE email='$id'";             
                $model =Author::model()->findBySql($sql);                
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
	 * @param Author $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='author-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
       
        
      
//==========================================Author Panel=======================================================      
        
        
        
        public function actionAuthorpanel($email)
        {   
            $model=new Model_Email;
            $profile_image_link=$this->get_user_profile_image_link($email);
                   
            $fetching_citation_details=$this->load_citation_details_for_user($email);            
            $total_downloads=$fetching_citation_details['1'];
            $total_views=$fetching_citation_details['2'];
            $total_published=$fetching_citation_details['3'];     
            $authors_full_name=$fetching_citation_details['4'];
            $author_since=$fetching_citation_details['5'];
            
            $names_of_published_papers=  $this->load_published_paper_names($email);
            
            $author_id=  $this->get_authors_id($email);
            
            $counting_notifications=Model_notifications::model()->countByAttributes(array('email'=>$email,'notification_seen'=>'Not seen yet'));
            
            $sql="SELECT * from tbl_paper NATURAL JOIN tbl_citation Where author_id='$author_id' AND paper_state='Congratulation! Paper has been published successfully!'";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $citation_details=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 5)));          
            
            
            if(isset($_POST['Model_Email']))
                {                               
                       $model->attributes=$_POST['Model_Email'];              
                       $model->profile_image_holder=CUploadedFile::getInstance($model,'profile_image_holder');                                              
                       if($model->profile_image_holder!==null)
                       {
                           if($model->profile_image_holder->getExtensionName()==='jpg' || $model->profile_image_holder->getExtensionName()==='png')
                       
                            {
                                $filename="{$email}_{$model->profile_image_holder}";
                                Model_Email::model()->updateByPk($email, array('profile_image'=>$filename));
                                $model->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename);
                                Yii::app()->user->setFlash("success", "<h4>Profile Picture Changed</h4>");
                                $this->refresh();
                            }
                            else
                            {
                                //$model->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename);
                                 Yii::app()->user->setFlash("error", "<h4>Only jpg or png images are allowed</h4>");
                            }
                       }
                       else
                       {
                           Yii::app()->user->setFlash("error", "<h4>You have not selected any image to update! Please Select an image.</h4>");        
                       }
                }
 
            $this->render('author_panel',array('authors_full_name'=>$authors_full_name,'total_downloads'=>$total_downloads,'total_views'=>$total_views,'total_published'=>$total_published,'paper_names'=>$names_of_published_papers,'profile_image'=>$profile_image_link,'model'=>$model,'counting_notifications'=>$counting_notifications,'citation_details'=>$citation_details,'author_since'=>$author_since));            
        }
     
        public function actionPaperuploader()
        {
          $this->render("paper_upload_form");
                                   
        }
        
        
        public function actionPaperstatus($id)
        {
            $model_paper=new Model_paper;
            $model=new Model_paper;
            if(isset($_POST['Model_paper']))
            {       
                       //$rnd=rand(1000000000, 1999999999);                       
                       //$model->attributes=$_POST['Model_paper'];                       
                       //$model->author_id=$this->get_author_id_by_email(Yii::app()->user->name);                       
                       $model->paper_file=CUploadedFile::getInstance($model,'paper_file');
                       $filename="{$model->paper_file}"; 
                       if($model->paper_file===null)
                       {
                            Yii::app()->user->setFlash('error', "<h4>File is missing! Please choose a file and submit again.</h4>");
                       }
                       else
                       {    
                            $check_paper_name_in_database=$this->check_paper_name_in_database($filename);
                            if($check_paper_name_in_database==='found')
                            {
                           
                                $checking_paper_status_for_next_action=$this->check_papers_current_status_for_next_action($filename);

                                if($checking_paper_status_for_next_action==="Paper Accepted! Please upload the final copy of the paper in both doc and pdf format.")
                                {
                                    $model->paper_file_pdf=CUploadedFile::getInstance($model,'paper_file_pdf');
                                    $filename2="{$model->paper_file_pdf}";
                                    if($model->paper_file_pdf===null)
                                    {
                                         Yii::app()->user->setFlash('error', "<h4>PDF Version of the paper is missing! Please submit your paper in both doc and pdf version together with same file name.</h4>");
                                    }
                                    else
                                    {    
                                        $check_both_filenames_are_same_or_not;
                                        $this->check_equality_of_both_file_names($filename, $filename2);
                                        
                                            $database_updating_result_for_final_copy=$this->update_paper_state_for_authors_final_copy_submission($filename);
                                            if($database_updating_result_for_final_copy==='success')
                                            {
                                               //$model->paper_file->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/'.$filename); 
                                               //$model->paper_file_pdf->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/pdf/'.$filename2); 
                                               //$updating_paper_state_as_final_copy_submitted;
                                               $model->paper_file->saveAs(Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS1/j#1%!23JqZdru%@_3349kp/accepted_doc_or_docx_papers/'.$filename);
                                               $model->paper_file->saveAs(Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS1/j#1%!23JqZdru%@_3349kp/accepted_pdf_versions/'.$filename2);


                                               Yii::app()->user->setFlash('success', "<h4>Final copy of the paper is submitted successfully! Keep patience to get your paper published. Thank you.</h4>");
                                            }
                                            else 
                                            {
                                                Yii::app()->user->setFlash('error',"<h4>Paper state could not be updated for final submission by author.</h4>");
                                            }

                                    }                           
                                }
                                else
                                {
                                     //$model->paper_file=CUploadedFile::getInstance($model,'paper_file'); 
                                     //$filename="{$model->paper_file}";  
                                     // $filename2="{$rnd}_{$model->paper_file_pdf}";                  
                                     $model->paper_state="Corrected paper in process again";                       
                                     $model->paper_title=$filename;

                                     if(($model->paper_file->getExtensionName()==='docx')) //|| $model->paper_file->getExtensionName()==='doc')) 
                                     {

                                          $result=$this->update_paper_state_of_corrected_copy($filename,$model->paper_state);        
                                          if($result==='Database updated for corrected paper')
                                          {
                                                $model->paper_file->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/'.$filename); 
                                             // $model->paper_file_pdf->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/pdf/'.$filename2); 

                                              Yii::app()->user->setFlash('success', "<h4>Corrected paper has been submitted successfully! Keep patience for editor's feedback.</h4>");
                                          }
                                          else                                
                                          {
                                              Yii::app()->user->setFlash('error',"Corrected Copy could not be submitted. Please check for the paper name and try again.");                                
                                          }
                                     }                      
                                     else 
                                     {
                                         //$this->redirect(CHtml::normalizeUrl(array("/author/authorpanel")));
                                          Yii::app()->user->setFlash('error', "Your file format is wrong. Upload only docx or doc file.");
                                     }

                                 }
                            }
                            else
                            {
                                Yii::app()->user->setFlash('error', "File name does not match with the name when you downloaded it. Please check the file name and try again.");
                            }
                            
                            
                            
                       }
                   
            }
            
            
            
                  
            
            $sql="SELECT * from tbl_author natural join tbl_paper Where email='$id' order by paper_id desc";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $model1=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 20)));
          
            $this->render('check_paper_status',array('model'=>$model1,'model_paper'=>$model_paper));
                       
        }
        
        public function check_paper($id)
	{
            
                $sql="SELECT * from tbl_paper WHERE author_id='$id'";
		//$model=  Model_paper::model()->findBySql($sql);
                
                $dataProvider=new CSqlDataProvider($sql);
		
                return $dataProvider;
                
//		if($model===NULL)
//			throw new CHttpException(404,'The requested page does not exist.');
//		return $model;
	}
        
        public function actionUpdatebyauthor($email)
	{
                $sql="SELECT * from tbl_author where email='$email'";
                $model=  Author::model()->findBySql($sql);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Author']))
		{
			$model->attributes=$_POST['Author'];
                        if($model->validate())
                        {
                                $model->save();
				$this->redirect (array("author/authorpanel",'email'=>$id));
                        }
		}

		$this->render('update_by_author',array('model'=>$model,));    //passing model data to the 'update' page
	}
        
        
        public function actionAuthor_notifications($email)
        {   
            $sql="SELECT * from tbl_notifications Where email='$email' ORDER BY notification_id DESC";
            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
            $model=new CSqlDataProvider($sql,array('keyField' => 'notification_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 10)));     
            $this->render('authors_notifications',array('model'=>$model));
       
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
            $this->actionAuthor_notifications(Yii::app()->user->name);            
        }
        
        
        
        
        
        
        
        
//--------------------------------------SUPPORTIVE GENERAL FUNCTIONS-------------------------------------------------
        
        
        
        public function load_citation_details_for_user($email) 
        {
            
            $connection= Yii::app()->db;
            
            $total_published=0;
            $total_downloads=0;
            $total_viewed_full=0;
                       
            $author_name;
            $author_since;
            
            $model=Author::model()->findAllByAttributes(array('email'=>$email));
            $list= CHtml::listData($model, 'author_first_name', 'author_last_name');
            foreach ($list as $key=>$value) 
            {
                $author_name=$key." ".$value;
            }
            $list=CHtml::listData($model, 'author_since', 'author_since');
            foreach($list as $value)
            {
                $author_since=$value;
            }
            
            
            $counter_sql="SELECT * from tbl_author natural join tbl_paper natural join tbl_citation where email='$email' && paper_state='Congratulation! Paper has been published successfully!'";
            $total_published=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $counter_sql . ') as count_alias')->queryScalar();
   
            $total_downloads_sql="SELECT sum(downloaded_full) from tbl_citation natural join tbl_paper natural join tbl_author where email='$email' && paper_state='Congratulation! Paper has been published successfully!'";
            $total_viewed_sql="SELECT sum(viewed_full) from tbl_citation natural join tbl_paper natural join tbl_author where email='$email' && paper_state='Congratulation! Paper has been published successfully!'";
                        
            $temp1=$connection->createCommand($total_downloads_sql)->queryScalar();
            $temp2=$connection->createCommand($total_viewed_sql)->queryScalar();
            
            if($temp1===null)
            {
                $total_downloads=0;
            }
            else $total_downloads=$temp1;
            if($temp2===null)
            {
                $total_viewed_full=0;
            }
            else $total_viewed_full=$temp1;
            
            //$total_downloads=$temp1;
            //$total_viewed_full=$temp2;

            $details_array=array('1'=>$total_downloads,'2'=>$total_viewed_full,'3'=>$total_published,'4'=>$author_name,'5'=>$author_since);
                        
            return $details_array;
                     
        }
        
        
        public function load_published_paper_names($email) 
        {
            $connection=  Yii::app()->db;
            $sql="SELECT * FROM tbl_author natural join tbl_paper where email='$email' && paper_state='Paper Accepted'";
            $ready=$connection->createCommand($sql);
            $model=$ready->queryAll();
            
            $list=  CHtml::listData($model, 'paper_title','paper_title');
            
            
            return $list;
            
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
        
        public function actionProfile_image_update()
        {
            $model=new Model_Email;
             $email=Yii::app()->user->name;
            if(isset($_POST['Model_Email']))
                {        
                       $result=1;
                       $model->attributes=$_POST['Model_Email'];              
                       $model->profile_image_holder=CUploadedFile::getInstance($model,'profile_image_holder');
                       $filename="{$email}_{$model->profile_image_holder}";
                       
                       //Model_Email::model()->updateByPk($email, array('profile_image'=>$filename));
                       
                       if($model->profile_image_holder!==null)
                       {
                           $model->profile_image_holder->saveAs(Yii::app()->basePath.'/profile_images/'.$filename);
                           Yii::app()->user->setFlash("success", "<h4>Profile pictre updated successfully.</h4>");
                           $this->redirect(array('author/author_panel','email'=>$email));
                       }
                       else
                       {
                            Yii::app()->user->setFlash("error", "<h4>Profile picture could not be changed</h4>");
                       }
             
                }
            
                $this->render('author');
         
        }


        
        public function update_paper_state_of_corrected_copy($paper_title,$paper_state) 
        {
            $connection=Yii::app()->db;
            $sql="UPDATE tbl_paper SET paper_state='$paper_state' WHERE paper_title like '%$paper_title%' AND paper_state='Paper Reviewed. See the corrections and submit it again.'";
            $ready=$connection->createCommand($sql);
            if($ready->execute())
            {
                return "Database updated for corrected paper";
            }
            else
            {
                return "Database could not be updated for the corrected paper";
            }
                                    
        }


        public function check_papers_current_status_for_next_action($paper_title) 
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
        
        
        public function update_paper_state_for_authors_final_copy_submission($paper_title) 
        {
            
            $connection=  Yii::app()->db;
            $sql="UPDATE tbl_paper SET paper_state='Author has submitted the final copy of the paper in both format.' WHERE paper_title like '%$paper_title%'";
            if($connection->createCommand($sql)->execute())
            {
                return "success";
            }
            else return "failed";
            
            
            
            
            
        }
        
        public function check_paper_name_in_database($paper_name)
        {
            $result= Model_paper::model()->findByAttributes(array('paper_title'=>$paper_name));
           if($result===null)
            {
                //Yii::app()->user->setFlash('error',"<h4>The file name does not match the database</h4>");
                return 'not found';      
            }
            else
            {
                return "found";
            }     
        }
        
        public function check_equality_of_both_file_names($doc_name,$pdf_name)
        {
                //$temp1=$doc_name;    
                $doc_len=  strlen($doc_name);
                $pdf_len=  strlen($pdf_name);
                                
                $check=substr($doc_name, $doc_len-1, $doc_len);
                $cut_docx;
                if($check==='x')
                {
                    $cut_docx=substr($doc_name, 0, -5);
                }
            //    else if($check==='c')
            //    {
            //         $cut_name= substr($doc_name, 0, -4);
            //    }
                
                $cut_pdf=substr($pdf_name, 0, -4);
                
                
                
                if($cut_pdf===$cut_docx)
                {
                    Yii::app()->user->setFlash('success',"same file name");
                    //return "same filename";
                }
                else
                {
                    Yii::app()->user->setFlash('error',"different file names");
                }
                
                
               //Yii::app()->user->setFlash('success',"file name is: $cut_pdf");
     
        }
        
        public function get_authors_id($email)
        {
            $authors_id;
            
            $model=Author::model()->findAllByAttributes(array('email'=>$email));
            $list=  CHtml::listData($model, 'author_id', 'author_id');
            foreach ($list as $value) {
                $authors_id=$value;
            }
            
            return $authors_id;
            
            
        }
        
        
        
        
        
        





       
        
       
        
        
        
}
