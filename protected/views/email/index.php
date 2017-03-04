<?php
/* @var $this EmailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model  Emails',
);

$this->menu=array(
	array('label'=>'Create Email', 'url'=>array('create')),
	array('label'=>'Manage Email', 'url'=>array('admin')),
);
?>

<h1>Model  Emails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
