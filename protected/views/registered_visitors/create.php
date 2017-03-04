<?php
/* @var $this Registered_visitorsController */
/* @var $model Model_RegisteredVisitors */

$this->breadcrumbs=array(
	'Model  Registered Visitors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Model_RegisteredVisitors', 'url'=>array('index')),
	array('label'=>'Manage Model_RegisteredVisitors', 'url'=>array('admin')),
);
?>

<h1>Create Model_RegisteredVisitors</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>