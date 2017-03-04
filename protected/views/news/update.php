<?php
/* @var $this NewsController */
/* @var $model Model_News */

$this->breadcrumbs=array(
	'Model  News'=>array('index'),
	$model->news_id=>array('view','id'=>$model->news_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_News', 'url'=>array('index')),
	array('label'=>'Create Model_News', 'url'=>array('create')),
	array('label'=>'View Model_News', 'url'=>array('view', 'id'=>$model->news_id)),
	array('label'=>'Manage Model_News', 'url'=>array('admin')),
);
?>

<h1>Update Model_News <?php echo $model->news_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>