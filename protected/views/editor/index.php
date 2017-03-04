<?php
/* @var $this EditorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model  Editors',
);

$this->menu=array(
	array('label'=>'Create Model_Editor', 'url'=>array('create')),
	array('label'=>'Manage Model_Editor', 'url'=>array('admin')),
);
?>

<h1 >Model  Editors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
