<?php
/* @var $this PaperController */
/* @var $model Model_paper */

$this->breadcrumbs=array(
	'Model Papers'=>array('index'),
	$model->paper_id,
);

$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array( // configurations per alert type
                            // success, info, warning, error or danger
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            ),
                            ));


//$this->menu=array(
//	array('label'=>'List Model_paper', 'url'=>array('index')),
//	array('label'=>'Create Model_paper', 'url'=>array('create')),
//	array('label'=>'Update Model_paper', 'url'=>array('update', 'id'=>$model->paper_id)),
//	array('label'=>'Delete Model_paper', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->paper_id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Model_paper', 'url'=>array('admin')),
//);
?>
<div class="row-fluid">
<h1>View Paper No: <?php echo $model->paper_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'paper_id',
		'author_id',
		'citation_id',
		'paper_title',
		'paper_field',
		'paper_subject',
		'issue_number',
		'volume_number',
		'paper_state',
		'acceptance_date',
		'paper_price',
		'paper_abstract',
	),
)); ?>
</div>