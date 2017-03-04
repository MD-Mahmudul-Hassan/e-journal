<?php
/* @var $this PaperController */
/* @var $model Model_paper */

$this->breadcrumbs=array(
	'Model Papers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Model_paper', 'url'=>array('index')),
	array('label'=>'Create Model_paper', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#model-paper-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Model Papers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">    
    <?php 
        $this->renderPartial('_search',array('model'=>$model,)); 
    ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'model-paper-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'paper_id',
		'author_id',
		'citation_id',
		'paper_title',
		'paper_field',
		'paper_subject',
		/*
		'issue_number',
		'volume_number',
		'paper_state',
		'acceptance_date',
		'paper_price',
		'paper_abstract',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
