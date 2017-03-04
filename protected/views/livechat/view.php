<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */

$this->breadcrumbs=array(
	'Model  Live Chats'=>array('index'),
	$model->chat_id,
);

$this->menu=array(
	array('label'=>'List Model_LiveChat', 'url'=>array('index')),
	array('label'=>'Create Model_LiveChat', 'url'=>array('create')),
	array('label'=>'Update Model_LiveChat', 'url'=>array('update', 'id'=>$model->chat_id)),
	array('label'=>'Delete Model_LiveChat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->chat_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Model_LiveChat', 'url'=>array('admin')),
);
?>

<h1>View Model_LiveChat #<?php echo $model->chat_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'chat_id',
		'email',
		'chat_date',
		'chat_time',
		'chat_message',
		'chat_pass_code',
	),
)); ?>
