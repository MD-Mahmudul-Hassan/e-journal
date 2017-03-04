<?php
/* @var $this PaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model Papers',
);

$this->menu=array(
	array('label'=>'List View', 'url'=>array('index')),
        array('label'=>'Submit paper', 'url'=>array('create')),     
        array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<h3>Paper List</h3>
<hr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
