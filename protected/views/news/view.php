<?php
/* @var $this NewsController */
/* @var $model Model_News */

$this->breadcrumbs=array(
	'Model  News'=>array('index'),
	$model->news_id,
);

$this->menu=array(
	array('label'=>'List Model_News', 'url'=>array('index')),
	array('label'=>'Create Model_News', 'url'=>array('create')),
	array('label'=>'Update Model_News', 'url'=>array('update', 'id'=>$model->news_id)),
	array('label'=>'Delete Model_News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->news_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_News', 'url'=>array('admin')),
);
?>

<h1>View Model_News #<?php echo $model->news_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'news_id',
		'admin_id',
		'news_date',
		'news_time',
		'news_heading',
		'news_body',
	),
)); ?>
