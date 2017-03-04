<?php
/* @var $this BlogadminController */
/* @var $model Model_blog */

$this->breadcrumbs=array(
	'Model Blogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Model_blog', 'url'=>array('index')),
	array('label'=>'Manage Model_blog', 'url'=>array('admin')),
);
?>

<h1>Create Model_blog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>