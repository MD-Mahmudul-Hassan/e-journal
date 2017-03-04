<?php
/* @var $this NewsController */
/* @var $model Model_News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'admin_id'); ?>
		<?php echo $form->textField($model,'admin_id'); ?>
		<?php echo $form->error($model,'admin_id'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'news_date'); ?>
		<?php echo $form->textField($model,'news_date',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'news_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_time'); ?>
		<?php echo $form->textField($model,'news_time',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'news_time'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'news_heading'); ?>
		<?php echo $form->textField($model,'news_heading',array('size'=>60,'maxlength'=>200,'class'=>'span10')); ?>
		<?php echo $form->error($model,'news_heading'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_body'); ?>
		<?php echo $form->textArea($model,'news_body',array('size'=>60,'maxlength'=>1000,'class'=>'span12','style'=>'height:200px;')); ?>
		<?php echo $form->error($model,'news_body'); ?>
	</div>

	<div class="row buttons" align="right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Publish' : 'Save',array('class'=>'btn btn-success span3')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->