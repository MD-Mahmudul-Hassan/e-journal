<?php
/* @var $this Registered_visitorsController */
/* @var $model Model_RegisteredVisitors */

$this->breadcrumbs=array(
	'Model  Registered Visitors'=>array('index'),
	$model->visitor_id=>array('view','id'=>$model->visitor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_RegisteredVisitors', 'url'=>array('index')),
	array('label'=>'Create Model_RegisteredVisitors', 'url'=>array('create')),
	array('label'=>'View Model_RegisteredVisitors', 'url'=>array('view', 'id'=>$model->visitor_id)),
	array('label'=>'Manage Model_RegisteredVisitors', 'url'=>array('admin')),
);
?>

<h1>Update Model_RegisteredVisitors <?php echo $model->visitor_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>