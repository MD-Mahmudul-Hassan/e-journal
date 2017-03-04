<?php
/* @var $this BlogadminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model Blogs',
);

$this->menu=array(
	array('label'=>'Create Model_blog', 'url'=>array('create')),
	array('label'=>'Manage Model_blog', 'url'=>array('admin')),
);
?>

<h1>Model Blogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
