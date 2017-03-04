<?php
/* @var $this Registered_visitorsController */
/* @var $model Model_RegisteredVisitors */

$this->breadcrumbs=array(
	'Model  Registered Visitors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Model_RegisteredVisitors', 'url'=>array('index')),
	array('label'=>'Create Model_RegisteredVisitors', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#model--registered-visitors-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Model  Registered Visitors</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'model--registered-visitors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'visitor_id',
		'visitor_first_name',
		'visitor_last_name',
		'email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
