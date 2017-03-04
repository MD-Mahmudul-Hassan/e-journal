<?php
/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'author-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        <p class="note">Make sure that you have filled up an Email form first then proceed to this form fill up.<br>If not, then click on the Email menu and select Create Email.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'author_first_name'); ?>
		<?php echo $form->textField($model,'author_first_name',array('size'=>60,'maxlength'=>100,'style'=>'border-radius:10px 10px 10px 10px;')); ?>
		<?php echo $form->error($model,'author_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_last_name'); ?>
		<?php echo $form->textField($model,'author_last_name',array('size'=>60,'maxlength'=>100,'style'=>'border-radius:10px 10px 10px 10px;')); ?>
		<?php echo $form->error($model,'author_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'style'=>'border-radius:10px 10px 10px 10px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->