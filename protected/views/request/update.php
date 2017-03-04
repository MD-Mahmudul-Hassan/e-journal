<?php
/* @var $this RequestController */
/* @var $model Model_request */

$this->breadcrumbs=array(
	'Model Requests'=>array('index'),
	$model->request_id=>array('view','id'=>$model->request_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_request', 'url'=>array('index')),
	array('label'=>'Create Model_request', 'url'=>array('create')),
	array('label'=>'View Model_request', 'url'=>array('view', 'id'=>$model->request_id)),
	array('label'=>'Manage Model_request', 'url'=>array('admin')),
);
?>

<h1>Update Model_request <?php echo $model->request_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>