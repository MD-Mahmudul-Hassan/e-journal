<?php
/* @var $this OptionsController */
/* @var $model Model_options */

$this->breadcrumbs=array(
	'Model Options'=>array('index'),
	$model->option_id,
);

$this->menu=array(
	array('label'=>'List Model_options', 'url'=>array('index')),
	array('label'=>'Create Model_options', 'url'=>array('create')),
	array('label'=>'Update Model_options', 'url'=>array('update', 'id'=>$model->option_id)),
	array('label'=>'Delete Model_options', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->option_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_options', 'url'=>array('admin')),
);
?>

<h1>View Model_options #<?php echo $model->option_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'option_id',
		'option_action_name',
		'option_action_state',
	),
)); ?>
