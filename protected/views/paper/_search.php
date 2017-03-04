<?php
/* @var $this PaperController */
/* @var $model Model_paper */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'paper_id'); ?>
		<?php echo $form->textField($model,'paper_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author_id'); ?>
		<?php echo $form->textField($model,'author_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'citation_id'); ?>
		<?php echo $form->textField($model,'citation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_title'); ?>
		<?php echo $form->textField($model,'paper_title',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_field'); ?>
		<?php echo $form->textField($model,'paper_field',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_subject'); ?>
		<?php echo $form->textField($model,'paper_subject',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'issue_number'); ?>
		<?php echo $form->textField($model,'issue_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'volume_number'); ?>
		<?php echo $form->textField($model,'volume_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_state'); ?>
		<?php echo $form->textField($model,'paper_state',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acceptance_date'); ?>
		<?php echo $form->textField($model,'acceptance_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_price'); ?>
		<?php echo $form->textField($model,'paper_price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_abstract'); ?>
		<?php echo $form->textField($model,'paper_abstract',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->