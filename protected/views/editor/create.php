<?php
/* @var $this EditorController */
/* @var $model Model_Editor */





//$this->breadcrumbs=array(
//	'Editors'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List Model_Editor', 'url'=>array('index')),
//	array('label'=>'Manage Model_Editor', 'url'=>array('admin')),
//);
?>
<div class="row-fluid">
<h2>Welcome! Just one step more.. </h2>
<hr>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>