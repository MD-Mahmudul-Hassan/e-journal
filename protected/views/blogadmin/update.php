<?php
/* @var $this BlogadminController */
/* @var $model Model_blog */

$this->breadcrumbs=array(
	'Model Blogs'=>array('index'),
	$model->comment_id=>array('view','id'=>$model->comment_id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Model_blog', 'url'=>array('index')),
//	array('label'=>'Create Model_blog', 'url'=>array('create')),
//	array('label'=>'View Model_blog', 'url'=>array('view', 'id'=>$model->comment_id)),
//	array('label'=>'Manage Model_blog', 'url'=>array('admin')),
//);

?>
<div class="row-fluid">

<h1>Update Model_blog <?php echo $model->comment_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>