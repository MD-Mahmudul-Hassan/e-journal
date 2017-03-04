<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'chat_id'); ?>
		<?php echo $form->textField($model,'chat_id',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chat_date'); ?>
		<?php echo $form->textField($model,'chat_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chat_time'); ?>
		<?php echo $form->textField($model,'chat_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chat_message'); ?>
		<?php echo $form->textField($model,'chat_message',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chat_pass_code'); ?>
		<?php echo $form->textField($model,'chat_pass_code',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->