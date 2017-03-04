<?php
/* @var $this Registered_visitorsController */
/* @var $model Model_RegisteredVisitors */

$this->breadcrumbs=array(
	'Model  Registered Visitors'=>array('index'),
	$model->visitor_id,
);

$this->menu=array(
	array('label'=>'List Model_RegisteredVisitors', 'url'=>array('index')),
	array('label'=>'Create Model_RegisteredVisitors', 'url'=>array('create')),
	array('label'=>'Update Model_RegisteredVisitors', 'url'=>array('update', 'id'=>$model->visitor_id)),
	array('label'=>'Delete Model_RegisteredVisitors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->visitor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_RegisteredVisitors', 'url'=>array('admin')),
);
?>

<h1>View Model_RegisteredVisitors #<?php echo $model->visitor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'visitor_id',
		'visitor_first_name',
		'visitor_last_name',
		'email',
	),
)); ?>
