<?php
/* @var $this OptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model Options',
);

$this->menu=array(
	array('label'=>'Create Model_options', 'url'=>array('create')),
	array('label'=>'Manage Model_options', 'url'=>array('admin')),
);
?>

<h1>Model Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
