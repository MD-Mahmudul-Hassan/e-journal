<?php
/* @var $this EditorController */
/* @var $model Model_Editor */



$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array( 
                            'success' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));



$this->breadcrumbs=array(
	'Editors Panel'=>array('editorspanel','email'=>  Yii::app()->user->name),
        'Update General Profile'=>array("updatebyeditor","email"=>Yii::app()->user->name)
);

//$this->menu=array(
//	array('label'=>'List Author', 'url'=>array('index')),
//	array('label'=>'Create Author', 'url'=>array('create')),
//	array('label'=>'View Author', 'url'=>array('view', 'id'=>$model->author_id)),
//	array('label'=>'Manage Author', 'url'=>array('admin')),
//);
?>

<h3>Updating <?php echo $model->editor_last_name; ?>'s profile</h3>

<?php $this->renderPartial('update_by_editor_form', array('model'=>$model)); ?>