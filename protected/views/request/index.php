<?php
/* @var $this RequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model Requests',
);

$this->menu=array(
	array('label'=>'Create Model_request', 'url'=>array('create')),
	array('label'=>'Manage Model_request', 'url'=>array('admin')),
);
?>

<h1>Model Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
