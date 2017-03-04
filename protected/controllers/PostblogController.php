<?php

class PostblogController extends Controller
{
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
        public function accessRules()
	{       $data=  Model_Email::model()->findAll("user_type='Admin'");
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
				'actions'=>array('admin','delete','blogging','index','postsearch'),
				'users'=>$admins,
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionCreate()
	{
		$model=new Model_blog;
                
                $email=Yii::app()->user->name;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                

                date_default_timezone_set('Asia/Dhaka');
                $currentDateTime=date('m/d/Y H:i:s');
                $currentTime = date('h:i A', strtotime($currentDateTime));
                $currentDate=date('d-m-Y', strtotime($currentDateTime));
		if(isset($_POST['Model_blog']))
		{
			$model->attributes=$_POST['Model_blog'];
                        $model->email=$email;
                        $model->comment_date= $currentDate;
                        $model->comment_time= $currentTime;                        
                        $model->user_name=$this->get_users_full_name($email);                                                
			if($model->save())
                        { 
                            $this->redirect(CHtml::normalizeUrl(array('postblog/index')));
                        }
                        else
                        {
                            
                            $this->redirect(CHtml::normalizeUrl(array('postblog/index')));
                        }
		}
                else
                {
                    //$model= $this->loadHeaders();
                    
                    $dataProvider=new CActiveDataProvider('Model_blog');
                    $this->render('index',array('dataProvider'=>$dataProvider,));
                }
	}
	public function actionBlogging()
	{
		//$this->render('blogging');
	}

	public function actionIndex()
	{
		
            $dataProvider=new CActiveDataProvider('Model_blog');
                
                
                
                 
//            $sql="SELECT * from tbl_blog";
//            $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();
//            $dataProvider=new CSqlDataProvider($sql,array('keyField' => 'comment_id','totalItemCount' => $count, 'pagination' => array('pageSize' => 10)));          
//               
               
            $this->render('index',array('dataProvider'=>$dataProvider,));
            
	}
        
        public function actionPostsearch($id)
        {
            $model= $this->postByMonth($id);                      
            if($model==='Not found')
            {
                
                $this->actionIndex();
            }
            else {  
                    $model=new Model_blog;
                    $this->render('recent_headings',array('model'=>$model,));
                 }
            
        }
        
        
        
        
        
//====================================SUPPORTIVE FUNCTIONS==================        
        
        
        
        
    public function get_users_full_name($email) 
    {
        $user_type;
        $user_name;
        $model=Model_Email::model()->findAllByPk($email);
        
        $data=  CHtml::listData($model, 'user_type','user_type');
        foreach ($data as $value) {
            $user_type=$value;
        }
        
        
        if($user_type==='Admin')
        {
            $sql="SELECT * from tbl_admin natural join tbl_blog where email='$email'";
            $model=Admin::model()->findAllBySql($sql);
            $data=  CHtml::listData($model, 'admin_first_name', 'admin_last_name');
            foreach ($data as $key => $value) {
                $user_name=$key." ".$value;
            }   
        }
        else if($user_type==="Author")
        {
            $sql="SELECT * from tbl_author natural join tbl_blog where email='$email'";
            $model=Author::model()->findAllBySql($sql);
            $data=  CHtml::listData($model, 'author_first_name', 'author_last_name');
            foreach ($data as $key => $value) {
                $user_name=$key." ".$value;
            }
            
        }
        else if($user_type==='Editor')
        {
            $sql="SELECT * from tbl_editor natural join tbl_blog where email='$email'";
            $model=  Model_Editor::model()->findAllBySql($sql);
            $data=  CHtml::listData($model, 'editor_first_name', 'editor_last_name');
            foreach ($data as $key => $value) {
                $user_name=$key." ".$value;
            }
            
        }
        
        
        return $user_name;
        
    }












    public function postByMonth($month)
        {
            $sql="SELECT * FROM tbl_blog WHERE comment_date like '$month%'";
            $model=  Model_blog::model()->findBySql($sql);  
            if($model!=NULL)
                {
                    return $model;
                }
            return 'Not found';
            
            
        }
        
        
        public function loadHeaders()
	{
                $sql="SELECT comment_heading FROM tbl_blog";
                
                $model = Model_blog::model()->findBySql($sql);                
                
                
                
		//else $this->renderPartial (CHtml::normalizeUrl(array('site/pages','view'=>'Registration')));
	}      

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}