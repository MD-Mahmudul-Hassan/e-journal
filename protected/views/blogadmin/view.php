<?php
/* @var $this BlogadminController */
/* @var $model Model_blog */

$this->breadcrumbs=array(
	'Model Blogs'=>array('index'),
	$model->comment_id,
);

$this->menu=array(
	array('label'=>'List Model_blog', 'url'=>array('index')),
	array('label'=>'Create Model_blog', 'url'=>array('create')),
	array('label'=>'Update Model_blog', 'url'=>array('update', 'id'=>$model->comment_id)),
	array('label'=>'Delete Model_blog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->comment_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_blog', 'url'=>array('admin')),
);
?>

<div class="row-fluid">
<h1>View Comment #<?php echo $model->comment_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'comment_id',
		'email',
		'comment_date',
		'comment_time',
		'comment_message',
	),
)); ?>

</div>
