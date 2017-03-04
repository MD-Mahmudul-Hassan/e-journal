<?php
/* @var $this LivechatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model  Live Chats',
);

$this->menu=array(
	array('label'=>'Create Model_LiveChat', 'url'=>array('create')),
	array('label'=>'Manage Model_LiveChat', 'url'=>array('admin')),
);
?>

<h1>Model  Live Chats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
