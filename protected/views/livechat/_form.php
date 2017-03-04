<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--live-chat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_date'); ?>
		<?php echo $form->textField($model,'chat_date'); ?>
		<?php echo $form->error($model,'chat_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_time'); ?>
		<?php echo $form->textField($model,'chat_time'); ?>
		<?php echo $form->error($model,'chat_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_message'); ?>
		<?php echo $form->textField($model,'chat_message',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'chat_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_pass_code'); ?>
		<?php echo $form->textField($model,'chat_pass_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'chat_pass_code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->