<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('public_view'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('public_view','admin','delete','create','update','index','view'),
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
		$model=new Model_News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                date_default_timezone_set('Asia/Dhaka');
                $currentDateTime=date('m/d/Y H:i:s');
                $currentTime = date('h:i A', strtotime($currentDateTime));
                $currentDate=date('d-m-Y', strtotime($currentDateTime));

		if(isset($_POST['Model_News']))
		{
			$model->attributes=$_POST['Model_News'];
                        $model->admin_id=$this->get_admin_id_from_email(Yii::app()->user->name);
                        $model->news_date=$currentDate;
                        $model->news_time=$currentTime;
                        
			if($model->save())
                        {
                            $this->redirect(array('view','id'=>$model->news_id));                        
                        }
                        else
                        {
                            Yii::app()->user->setFlash('success',"<h4>News has been published successfully!</h4>");
                        }
                        
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

		if(isset($_POST['Model_News']))
		{
			$model->attributes=$_POST['Model_News'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->news_id));
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
		$dataProvider=new CActiveDataProvider('Model_News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_News']))
			$model->attributes=$_GET['Model_News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        
        public function actionPublic_view()
        {
            
            $dataProvider=new CActiveDataProvider('Model_News');
		$this->render('public_view_index',array(
			'dataProvider'=>$dataProvider,
		));
            
        }
        
        
        
        
        
        
        

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Model_News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
//=====================SUPPORTIVE FUNCTIONS=============================
        
        public function get_admin_id_from_email($email) 
        {
            $admin_id=null;
            $model=  Admin::model()->findAllByAttributes(array('email'=>$email));            
            $list=  CHtml::listData($model,'admin_id','admin_id');
            foreach ($list as $value) {
                $admin_id=$value;
            }            
            return $admin_id;
     
        }
        
        
        
        
        
        
        
        
        
        
        
        
}
