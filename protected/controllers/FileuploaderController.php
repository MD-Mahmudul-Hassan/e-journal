<?php

class FileuploaderController extends Controller
{
    
    
    
    
	public function actionCreate()
	{     
                        
                $model=new File_uploader_model;
                if(isset($_POST['File_uploader_model']))
                {
                    $model->attributes=$_POST['File_uploader_model'];
                    $model->image=CUploadedFile::getInstance($model,'image');                 
                    
                    if($model->save())
                    {           
                        $model->image->saveAs(Yii::app()->basePath.'/papers/'.$model->image);   
                    }
                }
                //$this->render('create', array('model'=>$model));
                
		$this->render('create');
	}

	public function actionIndex()
	{
		$this->render('index');
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