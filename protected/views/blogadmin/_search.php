<?php
/* @var $this BlogadminController */
/* @var $model Model_blog */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>
        
        <div class="row">
		<?php echo $form->label($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'comment_date'); ?>
		<?php echo $form->textField($model,'comment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_time'); ?>
		<?php echo $form->textField($model,'comment_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_message'); ?>
		<?php echo $form->textField($model,'comment_message',array('size'=>60,'maxlength'=>1500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->