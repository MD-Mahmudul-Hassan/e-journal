<?php
/* @var $this RequestController */
/* @var $model Model_request */

$this->breadcrumbs=array(
	'Model Requests'=>array('index'),
	$model->request_id,
);

$this->menu=array(
	array('label'=>'List Model_request', 'url'=>array('index')),
	array('label'=>'Create Model_request', 'url'=>array('create')),
	array('label'=>'Update Model_request', 'url'=>array('update', 'id'=>$model->request_id)),
	array('label'=>'Delete Model_request', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->request_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_request', 'url'=>array('admin')),
);
?>

<h1>View Model_request #<?php echo $model->request_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'request_id',
		'email',
		'request_type',
		'request_subject',
		'request_message',
		'request_approval',
	),
)); ?>
