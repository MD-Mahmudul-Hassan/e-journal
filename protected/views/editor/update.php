<?php
/* @var $this EditorController */
/* @var $model Model_Editor */

$this->breadcrumbs=array(
	'Model  Editors'=>array('index'),
	$model->editor_id=>array('view','id'=>$model->editor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_Editor', 'url'=>array('index')),
	array('label'=>'Create Model_Editor', 'url'=>array('create')),
	array('label'=>'View Model_Editor', 'url'=>array('view', 'id'=>$model->editor_id)),
	array('label'=>'Manage Model_Editor', 'url'=>array('admin')),
);
?>

<h1>Update Model_Editor <?php echo $model->editor_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>