<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-form',
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
		<?php echo $form->labelEx($model,'admin_first_name'); ?>
		<?php echo $form->textField($model,'admin_first_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'admin_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_last_name'); ?>
		<?php echo $form->textField($model,'admin_last_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'admin_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'width:150px;background:#28BAD0;color:white;font-size:17px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->