<?php
/* @var $this RequestController */
/* @var $model Model_request */

$this->breadcrumbs=array(
	'Model Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Model_request', 'url'=>array('index')),
	array('label'=>'Create Model_request', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#model-request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Model Requests</h1>

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
	'id'=>'model-request-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'request_id',
		'email',
		'request_type',
		'request_subject',
		'request_message',
		'request_approval',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
