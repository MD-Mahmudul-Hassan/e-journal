<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->author_id,
);

$this->menu=array(
	array('label'=>'List Author', 'url'=>array('index')),
	array('label'=>'Create Author', 'url'=>array('create')),
	array('label'=>'Update Author', 'url'=>array('update', 'id'=>$model->author_id)),
	array('label'=>'Delete Author', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->author_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Author', 'url'=>array('admin')),
);
?>

<h1>View Author #<?php echo $model->author_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'author_id',
		'author_first_name',
		'author_last_name',
		'email',
	),
)); ?>
