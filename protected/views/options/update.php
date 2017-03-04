<?php
/* @var $this OptionsController */
/* @var $model Model_options */

$this->breadcrumbs=array(
	'Model Options'=>array('index'),
	$model->option_id=>array('view','id'=>$model->option_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Model_options', 'url'=>array('index')),
	array('label'=>'Create Model_options', 'url'=>array('create')),
	array('label'=>'View Model_options', 'url'=>array('view', 'id'=>$model->option_id)),
	array('label'=>'Manage Model_options', 'url'=>array('admin')),
);
?>

<h1>Update Model_options <?php echo $model->option_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>