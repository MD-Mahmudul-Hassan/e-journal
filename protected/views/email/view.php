<?php
/* @var $this EmailController */
/* @var $model Model_Email */

$this->breadcrumbs=array(
	'Model  Emails'=>array('index'),
	$model->email,
    
);
$type=array('text/html'=>'text/html','image/jpeg'=>'image/jpeg');
header('content-type:$type');
$this->menu=array(
	array('label'=>'List Model_Email', 'url'=>array('index')),
	array('label'=>'Create Model_Email', 'url'=>array('create')),
	array('label'=>'Update Model_Email', 'url'=>array('update', 'id'=>$model->email)),
	array('label'=>'Delete Model_Email', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->email),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_Email', 'url'=>array('admin')),
);
?>

<h1>View Model_Email #<?php echo $model->email; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		'password',
		'user_type',
		'contact_no',
		'address',
		'city',
		'country',
		'institution_name',
	),
)); ?>
