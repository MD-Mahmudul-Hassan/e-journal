<?php
/* @var $this OptionsController */
/* @var $model Model_options */
/* @var $form CActiveForm */


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-options-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'option_action_name'); ?>
		<?php echo $form->textField($model,'option_action_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'option_action_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'option_action_state'); ?>
		<?php echo $form->textField($model,'option_action_state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'option_action_state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->