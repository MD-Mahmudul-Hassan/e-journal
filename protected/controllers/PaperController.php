<?php

class PaperController extends Controller
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
			'accessControl',     // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{       $data=  Model_Email::model()->findAll("user_type='Admin'");
                $admins=  CHtml::listData($data, 'email', 'email');
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('downloadpaper','downloadindex','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','secured_download_paper','downloadpaper','downloadindex','feedback_paper_download'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','downloadpaper','downloadindex','downloadpaperaspdf','downloadbyeditor','reviewer_upload_form','first_review','feedback_paper_download','primary_paper_rejection_by_admin'),
				'users'=>array('@'),
			),
                       
                       // array('allow',array('actions'=>array('downloadbyeditor'),'users'=>array('editor'))),
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
            $connection=  Yii::app()->db;
            $citation_id_found;
            $model2=  Model_paper::model()->findAllByPk($id);                                                
            $list=  CHtml::listData($model2, 'citation_id', 'citation_id');                
            foreach ($list as $value) {
                $citation_id_found=$value;
            }                        
            $sql="UPDATE tbl_citation SET viewed_full=viewed_full+1 WHERE citation_id= '$citation_id_found'";
            $ready=$connection->createCommand($sql);
            
            if($ready->execute())
            {
                Yii::app()->user->setFlash('success', "<h3>Viewing the full details!</h3>");
            }
            else 
            {
                Yii::app()->user->setFlash('warning', "<h3>Citation Not updated</h3>");
            }
    
		$this->render('view',array('model'=>$this->loadModel($id),));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Model_paper;
               
                $connection= Yii::app()->db;  
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Model_paper']))
		{       
                       $rnd=rand(1000000000, 1999999999);                       
                       $model->attributes=$_POST['Model_paper'];
					   $docx_ext='docx';
                       //$model->author_id=$this->get_author_id_by_email(Yii::app()->user->name);
                       
                       $model->paper_file=CUploadedFile::getInstance($model,'paper_file');
                       //$model->paper_file_pdf=CUploadedFile::getInstance($model,'paper_file_pdf');                                              
                       $filename="{$rnd}_{$model->paper_title}.{$docx_ext}";
                       // $filename2="{$rnd}_{$model->paper_file_pdf}";                  
                       $model->paper_state="Waiting for admin response";                       
                       $model->paper_title=$filename;
                       if($model->paper_file===null)
                       {
                           Yii::app()->user->setFlash('error', "File is missing! Please choose a file and try again.");
                       }                
                       else if(($model->paper_file->getExtensionName()==='docx')) //|| $model->paper_file->getExtensionName()==='doc')) 
                       {
                       
         //------------A Citation id must be saved in the database first, then whole data should be saved in the paper table
                            $temp_value= rand(4000000, 4999999);                                                      
                            $sql="Insert Into tbl_citation (citation_id,viewed_abstract,downloaded_full,downloaded_abstract,viewed_full) VALUES ($temp_value,0,0,0,0)";
                            $command= $connection->createCommand($sql);           
                            if($command->execute())
                            {
                                $model->citation_id=$temp_value;
                                if($model->save())
                                {
                                    $model->paper_file->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/'.$filename); 
                                   // $model->paper_file_pdf->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/pdf/'.$filename2); 
                                    $this->redirect(CHtml::normalizeUrl(array("site/page","view"=>"paper_upload_success")));
                                }
                                else                                
                                {
                                    Yii::app()->user->setFlash('error',"Paper information could not be saved. Please try again.");                                
                                }
                            }
                            else
                             {
                                Yii::app()->user->setFlash('error',"Some problem occurred. Please try again.");
                             }
                       }                      
                       else 
                       {
                           //$this->redirect(CHtml::normalizeUrl(array("/author/authorpanel")));
                            Yii::app()->user->setFlash('error', "Your file format is wrong. Please upload docx files only.");
                       }                   
		}
                //Yii::app()->user->setFlash('success', "Success");
                
                $model->author_id=$this->get_author_id_by_email(Yii::app()->user->name);
                $fields=  $this->get_paper_fields();
                
		$this->render('create',array('model'=>$model,'paper_fields'=>$fields));
                
                
                
	}

        public function get_author_id_by_email($email) {
            $author_id=null;
            $model=  Author::model()->findAllByAttributes(array('email'=>$email));
            $list=  CHtml::listData($model, 'author_id','author_id');
            foreach ($list as $value) {
                $author_id=$value;
            }
            return $author_id;
            
            
            
            
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

		if(isset($_POST['Model_paper']))
		{
			$model->attributes=$_POST['Model_paper'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->paper_id));
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
		$dataProvider=new CActiveDataProvider('Model_paper');
                $this->render('index',array('dataProvider'=>$dataProvider,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_paper('search');
		$model->unsetAttributes();        // clear any default values
		if(isset($_GET['Model_paper']))
			$model->attributes=$_GET['Model_paper'];

		$this->render('admin',array('model'=>$model,));
	}
	public function loadModel($id)
	{
		$model=Model_paper::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model-paper-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        
       
        
        
//========================================Downloader===========================================================     
        
        
        
        public function actionDownloadpaper($name)
        {                       
            $connection=Yii::app()->db;
//            $dataprovider=new CActiveDataProvider('Model_paper', 
//                 array(
//                    'criteria'=>array('condition'=>"paper_state='Congratulation! Paper has been published successfully!'",'order'=>'paper_id DESC',),
//                    //'with'=>array('author'),
//                    'countCriteria'=>array('condition'=>"paper_state='Congratulation! Paper has been published successfully!'",),
//                    'pagination'=>array('pageSize'=>5,),
//                     )  
//            );
            
            if($name===null)
            {
                Yii::app()->user->setFlash('error', "Paper name not defined!");
            }            
            else
            {
                    $src= Yii::app()->basePath."/accepted_papers/ty#@kio12e2qz34%!@216splk53sS13TY2#Weytu23jEC@tp37610@%aR!#lZopPMao[]/j#1%!23JqZdru%@_3349kp_%E43#@!srY97#@!DFG_#@ZP@GL#3@8eP21/accepted_doc_or_docx_papers/$name";          
                    if(file_exists($src) && $name!=null)
                    {            
                        //Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        //Yii::app()->user->setFlash('success', "File found! Downloading..");
                        
                        $sql1="SELECT * FROM tbl_paper NATURAL JOIN tbl_citation WHERE paper_title='$name'";
                        $model2=  Model_paper::model()->findAllBySql($sql1);                                                
                        $list=  CHtml::listData($model2, 'paper_title', 'citation_id');                
                        $citation_id_found=$list[$name];                       
                        $sql="UPDATE tbl_citation SET downloaded_full=downloaded_full+1 WHERE citation_id= $citation_id_found";                        
                        $command=$connection->createCommand($sql);
                        
                        if($command->execute())
                        {                            
                            Yii::app()->user->setFlash('success', "Download successfully!");
                            Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        }
                        else 
                        {
                            Yii::app()->user->setFlash('error', "Check MySql query");
                        }                      
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', "The file is not found in the system!");
                    }
            }
           
            //$this->render("download_index_page",array("dataProvider"=>$dataprovider,'model'=>$model));                   
        $this->redirect(array('paper/downloadindex'));
          
   }
        
        
        public function actionDownloadpaperaspdf($name)
        {          
            $temp=$name;
            $pdf="pdf";
            $len=strlen($temp);
            $check= substr($temp, $len-1, $len);
            $cut_name;
            if($check==='x')
            {
                $cut_name=substr($temp, 0, -5);
            }
            else if($check==='c')
            {
                 $cut_name= substr($temp, 0, -4);
            }
            $name="{$cut_name}.{$pdf}";
            if($name===null)
            {
                Yii::app()->user->setFlash('error', "Paper name not defined!");
            }            
            else
            {                                    
                $src=Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS13TY2#Weytu23jEC@tp37610@%aR!#lZopPMao[]/j#1%!23JqZdru%@_3349kp_%E43#@!srY97#@!DFG_#@ZP@GL#3@8eP21/accepted_pdf_versions/'.$name;                             
                if(file_exists($src) && $name!=null)
                {            
                    Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                    //Yii::app()->user->setFlash('success', "File found! Downloading..");
                    $this->redirect(array('paper/downloadindex'));
                }
                else
                {
                    Yii::app()->user->setFlash('error', "<h4>The pdf version of this paper is not found in the system!</h4>");
                }                                        
            }
           
//            $this->render("download_index_page",array("dataProvider"=>$dataprovider,'model'=>$model));                   
        
              $this->redirect(array('paper/downloadindex'));
         }
        
                
       public function actionDownloadindex()
        {   
            $model=new Model_paper;
            
            $dataprovider=null;
            $condition=null;
            $fields=$this->get_paper_fields();
            if(isset($_POST['Model_paper']))
            {                                                 
                       $model->attributes=$_POST['Model_paper'];
                       
                       if($model->paper_title!==null || $model->paper_field!==null || $model->issue_number!==null || $model->volume_number!==null)
                         {
                             if($model->paper_field==='Select a field')
                             {
                                 $condition="paper_title like '%$model->paper_title%' AND issue_number like '%$model->issue_number%' AND volume_number like '%$model->volume_number%'  AND paper_state='Congratulation! Paper has been published successfully!'";
                                 
                             } 
                             else
                             {
                                 $condition="paper_title like '%$model->paper_title%' AND paper_field like '%$model->paper_field%' AND issue_number like '%$model->issue_number%' AND volume_number like '%$model->volume_number%'  AND paper_state='Congratulation! Paper has been published successfully!'";
                             }
                             
                           }
                       
                             $dataprovider=new CActiveDataProvider('Model_paper', 
                                    array(
                                       'criteria'=>array(
                                           'with'=>array('author'=>array('joinType'=>'LEFT JOIN')),
                                           'condition'=>$condition, 
                                           'order'=>'paper_id DESC',
                                           ),
                                       
                                       'countCriteria'=>array('condition'=>$condition),
                                       'pagination'=>array('pageSize'=>5,),
                                        )  
                                        );
                           
                           $model->paper_title=null;
                           $model->issue_number=null;
                           $model->volume_number=null;
                           
                }
             
                 if($dataprovider===null)
                 {
                    $model->unsetAttributes();
                    $dataprovider=new CActiveDataProvider('Model_paper', 
                        array(
                           'criteria'=>array(
                               'with'=>array('author'=>array('joinType'=>'LEFT JOIN'),'citation'=>array('joinType'=>'LEFT JOIN')),
                               'condition'=>"paper_state='Congratulation! Paper has been published successfully!'",
                               'order'=>'paper_id DESC',),
                           //'with'=>array('author'),
                           'countCriteria'=>array('condition'=>"paper_state='Congratulation! Paper has been published successfully!'",),
                           'pagination'=>array('pageSize'=>5,),
                            )  
                       );
                    
//                    $criteria = new CDbCriteria;
//                    $criteria->select = '*';
//                    $criteria->with = array('author'=>array('select'=>'author_first_name'));
//                    $criteria->condition=array("paper_state"=>'Congratulation! Paper has been published successfully!');
//                    $dataprovider = new CActiveDataProvider('Model_paper', 
//                                        array('criteria' => $criteria,
//                                        'pagination' => array(
//                                            'pageSize' => 10,
//                                        ),
//                                    ));
                    
                 }
            $this->render("download_index_page",array("dataProvider"=>$dataprovider,'model'=>$model,'fields'=>$fields));
        }
        
        
        
        
        
        
        
        
        
        
        
//------------------------------------Reviewer Panel work----------------------------------------------------------        
        
        
        public function actionDownloadbyeditor($id)
        {   
            
            $sql="Select * from tbl_paper where paper_id=$id";            
            $model=Model_paper::model()->findAllBySql($sql);                        
            $list=CHtml::listData($model, 'paper_id', 'paper_title');
            
            $name=$list[$id];
            
           // $name=$list['paper_id'];  
           // $sql="SELECT * from tbl_paper_editors NATURAL JOIN tbl_paper Where editor_id='$id'";
           // $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
           // $model=new CSqlDataProvider($sql,array('keyField' => 'paper_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 5)));          
           
            if($id===null)
            {
                Yii::app()->user->setFlash('error', "<h3>Paper name not defined!</h3>");
            }            
            else
            {   
                $src;
                $checking_paper_status_for_next_action=$this->check_papers_current_status_for_next_action($id);                      
                if($checking_paper_status_for_next_action==='Author has submitted the final copy of the paper in both format.')
                {
                    $src=Yii::app()->basePath.'/accepted_papers/ty#@kio12e2qz34%!@216splk53sS13TY2#Weytu23jEC@tp37610@%aR!#lZopPMao[]/j#1%!23JqZdru%@_3349kp_%E43#@!srY97#@!DFG_#@ZP@GL#3@8eP21/accepted_doc_or_docx_papers/'.$name;
                    if(file_exists($src) && $name!=null)
                    {            
                        Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        Yii::app()->user->setFlash('success', "<h3>File Downloading..</h3>");
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', "<h4>The author has not submitted the doc/docx version of this paper yet. Please keep patience for authors final submission.</h4>");
                    }                                        
                }
                else
                {                
                    $src= Yii::app()->basePath."/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/doc/$name";          
                    if(file_exists($src) && $name!=null)
                    {            
                        Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        Yii::app()->user->setFlash('success', "<h3>File Downloading..</h3>");
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', "<h4>The file is not found in the system!</h4>");
                    }
                }
            }
           
            $this->redirect(CHtml::normalizeUrl(array('editor/editorspanel','email'=>  Yii::app()->user->name)));
            
            //$this->render("/editor/editors_panel",array("dataProvider"=>$dataprovider));                   
        }
        
        public function actionReviewer_upload_form()
        {
            $model=new Model_paper;   
            $this->render('reviewer_file_upload_form',array('model'=>$model,));
        }
        
        
        
        
        
        public function actionFirst_review()
        {
            $model=new Model_paper;
            
            $connection= Yii::app()->db;  
            
            if(isset ($_POST['Model_paper']))
            {
                $model->attributes=$_POST['Model_paper'];
                $model->paper_file=CUploadedFile::getInstance($model,'paper_file');
               
                if($model->paper_file===NULL)
                {                    
                        Yii::app()->user->setFlash('error', "File is missing! Please choose a file and try again.");                       
                }
                else if(($model->paper_file->getExtensionName()==="doc" || $model->paper_file->getExtensionName()==="docx"))
                {
                        $paper_name=$model->paper_file->getName();
         
                        $checking_if_the_paper_name_mathches_the_database=$this->check_paper_name_in_database($paper_name);
                        if($checking_if_the_paper_name_mathches_the_database==='found')
                        {
                            $checking_if_the_paper_is_already_published=$this->check_papers_current_status_for_next_action_by_paper_name($paper_name);
                            if($checking_if_the_paper_is_already_published==="Congratulation! Paper has been published successfully!" || $checking_if_the_paper_is_already_published==="Paper Accepted! Please upload the final copy of the paper in both doc and pdf format.")
                            {
                                Yii::app()->user->setFlash('error', "<h4>This paper is already published or its author is already asked for his/her final submission. Please submit those papers which are still in reviewing process.</h4>");
                            }
                            else
                            {                            
                                $model->paper_state="Paper Reviewed. See the corrections and submit it again.";
                                $sql="UPDATE tbl_paper SET paper_state='$model->paper_state' WHERE paper_title like '%$paper_name%'";   
                                $command=$connection->createCommand($sql);                
                                if($command->execute())
                                {
                                    $model->paper_file->saveAs(Yii::app()->basePath.'/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/first_order_reviewed/'.$model->paper_file);
                                    Yii::app()->user->setFlash('success', "Paper uploaded successfully!");
                                }
                                else {         
                                    Yii::app()->user->setFlash('warning', "Operation already done!");
                                }
                            }
                            
                        }
                        else
                        {
                            Yii::app()->user->setFlash('info', "<h4>The file name does not match with the name when you downloaded. Please check the file name and try again.</h4>");
                        }
                }
                else
                {
                        Yii::app()->user->setFlash('error', "File type mismatch! Please upload only doc or docx file.");                       
            
                }
         
            }
            
            
            $this->render('reviewer_file_upload_form',array('model'=>$model,));
            
        }
        
        
        
//===========================================Author Panel work===================================================        

        
        
        public function actionFeedback_paper_download($id)
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
                    $src= Yii::app()->basePath."/paper_storage/abaketiabcssba12f6ya14yu259wqk21c1/#u%@iewqhb48$!4baf5a1@167k3%&1aj@faggks@n$!uty#bmz/first_order_reviewed/$name";          
                    if(file_exists($src) && $name!=null)
                    {            
                        Yii::app()->getRequest()->sendFile( "$name" , file_get_contents( $src ) );
                        Yii::app()->user->setFlash('success', "File found! Downloading..");
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning', "<h4>The file is not reviewed yet. Please keep patience for Editor's feedback.</h4>");
                    }
            }
           
             $this->redirect(CHtml::normalizeUrl(array('/author/paperstatus','id'=>  Yii::app()->user->name)));
            
            
        }
        
        
        
    
        
        
        
        
        
//============================================User Request handler=============================================        
        
        public function actionSecured_download_paper()
        {
            
            $secured_download_pass;
            $request_id;
            $model=new Model_request;
            $connection=  Yii::app()->db;
            if(isset($_POST['Model_request']))
            {
                
                $model->attributes=$_POST['Model_request'];
                
                $secured_download_pass=$this->verifying_passcode($model->request_approval);
                $request_id=$this->getting_request_id($model->request_approval);
                
                if($secured_download_pass==='Passcode not found' || $secured_download_pass===null || $request_id===null)
                {
                    Yii::app()->user->setFlash('error', "Passcode not found!");
                }            
                else
                {
                       $src= Yii::app()->basePath."/accepted_papers/ty#@kio12e2qz34%!@216splk53sS13TY2#Weytu23jEC@tp37610@%aR!#lZopPMao[]/j#1%!23JqZdru%@_3349kp_%E43#@!srY97#@!DFG_#@ZP@GL#3@8eP21/$secured_download_pass";          
                        if(file_exists($src))
                        {            
                                
                                $sql="UPDATE tbl_request SET request_approval='Action Done' WHERE request_id='$request_id'";   
                                 $command=$connection->createCommand($sql);                
                                 $command->execute();                                 
                                Yii::app()->getRequest()->sendFile( "$secured_download_pass" , file_get_contents( $src ) );                                                      
                                            
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error', "The file is not found in the system!");
                        }
                }
            }
     
            $this->redirect(CHtml::normalizeUrl(array('/request/request_viewer_by_user','email'=>  Yii::app()->user->name)));
      
        }
        
        
        public function verifying_passcode($code)
        {
            $temp_name=null;
            $sql="Select * from tbl_request where request_approval='$code'";
            $model=  Model_request::model()->findAllBySql($sql);            
            if($model===null)
            {
                return "Passcode not found";
            }
            else 
            {
                $list = CHtml::listData($model,'request_id', 'request_subject');
                foreach ($list as $key => $value) 
                {
                    $temp_name=$value;
                }                
                return $temp_name;    
            }
        }
        
        public function getting_request_id($code)
        {
            $target_id=NULL;
            $sql="Select * from tbl_request where request_approval='$code'";
            $model=  Model_request::model()->findAllBySql($sql); 
            $list = CHtml::listData($model,'request_id', 'request_id');
            foreach ($list as $key => $value) 
            {
                $target_id=$value;
            }                
            return $target_id;   
        }
        
        
        
        
//---------------------------------SUPPORTIVE FUNCTIONS----------------------------------------
        
        
        
    public function get_paper_fields() {
        
        $fields=array(
            'Select a field'=>'Select a field',
            'International human rights law'=>'International human rights law',
            'Intellectual Property Rights'=>'Intellectual Property Rights',
            'Criminological Analysis of Crime and Deviance'=>'Criminological Analysis of Crime and Deviance',
            'Law and Order in South Asia'=>'Law and Order in South Asia',
            'Law and Technology in 21st century'=>'Law and Technology in 21st century',
            'Islam, Hinduism and Buddhism on Human Rights'=>'Islam, Hinduism and Buddhism on Human Rights',
            'ADR (Alternative Dispute Resolution) and ODR (Online Dispute Resolution)'=>'ADR (Alternative Dispute Resolution) and ODR (Online Dispute Resolution)',
            'Law, Politics and Social Sciences'=>'Law, Politics and Social Sciences',
           ' Legal and/or Political History of Civilization'=>'Legal and/or Political History of Civilization',
            'Law and Philosophy'=>'Law and Philosophy',
            'Legal and Social Reforms in times'=>'Legal and Social Reforms in times',
            'Terrorism in Politics'=>'Terrorism in Politics',
           ' Environmental Law'=>'Environmental Law',
            'Rights and Duties under personal laws'=>'Rights and Duties under personal laws',
            'Migration and Refugee Law'=>'Migration and Refugee Law',
            'Law and Development'=>'Law and Development',
            'International Trade Law'=>'International Trade Law',
            'Law of Obligation'=>'Law of Obligation',
            'Competition Law'=>'Competition Law',
            'International Commercial Arbitration'=>'International Commercial Arbitration',
            'Legal Theory'=>'Legal Theory',	
            'Comparative Law'=>'Comparative Law',
   );
        
        
        
   return $fields; 
        
        
        
    }
    
    
    public function check_papers_current_status_for_next_action($paper_id) 
    {
            $result=null;
            
            $data=  Model_paper::model()->findAllByPk($paper_id);
            
//            $connection=Yii::app()->db;
//            $sql="SELECT * from tbl_paper WHERE paper_title like '%$paper_title%'";
//            $ready=$connection->createCommand($sql);
//            $data=$ready->queryAll();            
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






        public function check_papers_current_status_for_next_action_by_paper_name($paper_name) 
        {
            $result=null;           
            $data=Model_paper::model()->findAllByAttributes(array('paper_title'=>$paper_name));          
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
