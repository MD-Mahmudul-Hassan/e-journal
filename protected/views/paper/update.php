<?php
/* @var $this PaperController */
/* @var $model Model_paper */

$this->breadcrumbs=array(
	'Model Papers'=>array('index'),
	$model->paper_id=>array('view','id'=>$model->paper_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_paper', 'url'=>array('index')),
	array('label'=>'Create Model_paper', 'url'=>array('create')),
	array('label'=>'View Model_paper', 'url'=>array('view', 'id'=>$model->paper_id)),
	array('label'=>'Manage Model_paper', 'url'=>array('admin')),
);
?>

<div class="row-fluid">
<h3>Update Paper No: <?php echo $model->paper_id; ?></h3><hr>

<?php $this->renderPartial('update_form_for_admin', array('model'=>$model)); ?>
</div>