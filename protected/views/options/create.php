<?php
/* @var $this OptionsController */
/* @var $model Model_options */

$this->breadcrumbs=array(
	'Model Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Model_options', 'url'=>array('index')),
	array('label'=>'Manage Model_options', 'url'=>array('admin')),
);
?>

<h1>Create Model_options</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>