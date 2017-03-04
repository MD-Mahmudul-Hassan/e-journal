<?php
/* @var $this BlogadminController */
/* @var $model Model_blog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-blog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_date'); ?>
		<?php echo $form->textField($model,'comment_date'); ?>
		<?php echo $form->error($model,'comment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_time'); ?>
		<?php echo $form->textField($model,'comment_time'); ?>
		<?php echo $form->error($model,'comment_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_message'); ?>
		<?php echo $form->textArea($model,'comment_message',array('size'=>60,'maxlength'=>1500,'class'=>'span5','style'=>'height:100px;')); ?>
		<?php echo $form->error($model,'comment_message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->