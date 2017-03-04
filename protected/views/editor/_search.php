<?php
/* @var $this EditorController */
/* @var $model Model_Editor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'editor_id'); ?>
		<?php echo $form->textField($model,'editor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'editor_first_name'); ?>
		<?php echo $form->textField($model,'editor_first_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'editor_last_name'); ?>
		<?php echo $form->textField($model,'editor_last_name',array('size'=>60,'maxlength'=>100)); ?>
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