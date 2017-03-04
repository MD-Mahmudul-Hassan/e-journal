<?php
/* @var $this Model_RegisteredVisitorsController */
/* @var $model Model_RegisteredVisitors */
/* @var $form CActiveForm */



$model=new Model_RegisteredVisitors;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--registered-visitors-register_visitors_form-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>array('registered_visitors/register_visitors'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'visitor_first_name'); ?>
		<?php echo $form->textField($model,'visitor_first_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'visitor_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visitor_last_name'); ?>
		<?php echo $form->textField($model,'visitor_last_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'visitor_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('style'=>'width:150px;background:#28BAD0;color:white;font-size:17px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->