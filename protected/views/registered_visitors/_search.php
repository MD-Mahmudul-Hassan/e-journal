<?php
/* @var $this Registered_visitorsController */
/* @var $model Model_RegisteredVisitors */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'visitor_id'); ?>
		<?php echo $form->textField($model,'visitor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visitor_first_name'); ?>
		<?php echo $form->textField($model,'visitor_first_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visitor_last_name'); ?>
		<?php echo $form->textField($model,'visitor_last_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->