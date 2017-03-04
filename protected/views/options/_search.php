<?php
/* @var $this OptionsController */
/* @var $model Model_options */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'option_id'); ?>
		<?php echo $form->textField($model,'option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'option_action_name'); ?>
		<?php echo $form->textField($model,'option_action_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'option_action_state'); ?>
		<?php echo $form->textField($model,'option_action_state',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->