<?php
/* @var $this NewsController */
/* @var $model Model_News */

$this->breadcrumbs=array(
	'Model  News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Model_News', 'url'=>array('index')),
	array('label'=>'Manage Model_News', 'url'=>array('admin')),
);
?>

<div class="row-fluid">
<h1>Create News</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>