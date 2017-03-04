<?php
/* @var $this EmailController */
/* @var $model Model_Email */





$this->breadcrumbs=array(
	'Model  Emails'=>array('index'),
	$model->email=>array('view','id'=>$model->email),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_Email', 'url'=>array('index')),
	array('label'=>'Create Model_Email', 'url'=>array('create')),
	array('label'=>'View Model_Email', 'url'=>array('view', 'id'=>$model->email)),
	array('label'=>'Manage Model_Email', 'url'=>array('admin')),
);
?>

<h1>Update Model_Email <?php echo $model->email; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>