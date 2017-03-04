<?php
/* @var $this EditorController */
/* @var $model Model_Editor */

$this->breadcrumbs=array(
	'Model  Editors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Model_Editor', 'url'=>array('index')),
	array('label'=>'Create Model_Editor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#model--editor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Model  Editors</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php echo CHtml::link('Create Editor',Yii::app()->createUrl('email/Register_editor_by_admin'),array("class"=>"btn btn-success"));?>
<?php echo "<br><br>".CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'model--editor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'editor_id',
		'editor_first_name',
		'editor_last_name',
		'email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
