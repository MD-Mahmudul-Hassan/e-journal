<?php
/* @var $this Registered_visitorsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model  Registered Visitors',
);

$this->menu=array(
	array('label'=>'Create Model_RegisteredVisitors', 'url'=>array('create')),
	array('label'=>'Manage Model_RegisteredVisitors', 'url'=>array('admin')),
);
?>

<h1>Model  Registered Visitors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
