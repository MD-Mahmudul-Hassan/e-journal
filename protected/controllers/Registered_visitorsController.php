<?php

class Registered_visitorsController extends Controller
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
				'actions'=>array('admin','delete','register_visitors'),
				'users'=>array('admin'),
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
		$model=new Model_RegisteredVisitors;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Model_RegisteredVisitors']))
		{
			$model->attributes=$_POST['Model_RegisteredVisitors'];
			 if($this->checkForDuplicateEntry($model->email)==='valid')
                             {
                                if($model->save())
                                        $this->redirect(array('view','id'=>$model->visitor_id));
                             }
                         else $this->redirect(CHtml::normalizeUrl(array('registered_visitors/create')));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionRegister_visitors()
        {
                $model=new Model_RegisteredVisitors;

                // uncomment the following code to enable ajax-based validation
                /*
                if(isset($_POST['ajax']) && $_POST['ajax']==='model--registered-visitors-register_visitors_form-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
                */

                if(isset($_POST['Model_RegisteredVisitors']))
                {
                    $model->attributes=$_POST['Model_RegisteredVisitors'];
                     if($this->checkForDuplicateEntry($model->email)==='valid'){
                            if($model->validate())
                            {
                                 $model->save();
                                 $this->redirect(CHtml::normalizeUrl(array('site/login')));
                            }
                     }
                     else  $this->redirect(CHtml::normalizeUrl(array('site/page','view'=>'register_visitors_form')));
                }
                $this->render('register_visitors_form',array('model'=>$model));
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

		if(isset($_POST['Model_RegisteredVisitors']))
		{
			$model->attributes=$_POST['Model_RegisteredVisitors'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->visitor_id));
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
		$dataProvider=new CActiveDataProvider('Model_RegisteredVisitors');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Model_RegisteredVisitors('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Model_RegisteredVisitors']))
			$model->attributes=$_GET['Model_RegisteredVisitors'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Model_RegisteredVisitors the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Model_RegisteredVisitors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function checkForDuplicateEntry($id)
	{
                $sql="SELECT * FROM tbl_registered_visitors WHERE email='$id'";
                
                $model = Model_RegisteredVisitors::model()->findBySql($sql);                
                if($model===NULL)     //  if Email is not used by other visitors
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
	 * @param Model_RegisteredVisitors $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='model--registered-visitors-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
