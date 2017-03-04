<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */

$this->breadcrumbs=array(
	'Model  Live Chats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Model_LiveChat', 'url'=>array('index')),
	array('label'=>'Manage Model_LiveChat', 'url'=>array('admin')),
);
?>

<h1>Create Model_LiveChat</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>