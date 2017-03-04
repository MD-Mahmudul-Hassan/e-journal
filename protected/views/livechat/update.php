<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */

$this->breadcrumbs=array(
	'Model  Live Chats'=>array('index'),
	$model->chat_id=>array('view','id'=>$model->chat_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_LiveChat', 'url'=>array('index')),
	array('label'=>'Create Model_LiveChat', 'url'=>array('create')),
	array('label'=>'View Model_LiveChat', 'url'=>array('view', 'id'=>$model->chat_id)),
	array('label'=>'Manage Model_LiveChat', 'url'=>array('admin')),
);
?>

<h1>Update Model_LiveChat <?php echo $model->chat_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>