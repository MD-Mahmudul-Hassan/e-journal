<?php
/* @var $this EditorController */
/* @var $model Model_Editor */

$this->breadcrumbs=array(
	'Model  Editors'=>array('index'),
	$model->editor_id,
);

$this->menu=array(
	array('label'=>'List Model_Editor', 'url'=>array('index')),
	array('label'=>'Create Model_Editor', 'url'=>array('create')),
	array('label'=>'Update Model_Editor', 'url'=>array('update', 'id'=>$model->editor_id)),
	array('label'=>'Delete Model_Editor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->editor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_Editor', 'url'=>array('admin')),
);
?>

<h1>View Model_Editor #<?php echo $model->editor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'editor_id',
		'editor_first_name',
		'editor_last_name',
		'email',
	),
)); ?>
