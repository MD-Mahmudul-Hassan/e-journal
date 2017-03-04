<?php
/* @var $this PaperController */
/* @var $model Model_paper */
/* @var author_id */





$this->breadcrumbs=array(
	//'Model Papers'=>array('index'),
	'Create'=>array('create'),
);

  

?>
<div class="row-fluid">
<h4>Paper Submission form</h4>
<hr>
<?php $this->renderPartial('_form', array('model'=>$model,'paper_fields'=>$paper_fields)); ?>

</div>