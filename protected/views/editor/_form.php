<?php
/* @var $this EditorController */
/* @var $model Model_Editor */
/* @var $form CActiveForm */
?>


<div class="form row-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--editor-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

    <p>Fill the fields below and verify your email that you have entered in the previous page</p>
	<?php echo $form->errorSummary($model); ?>
        
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'editor_first_name'); ?>
		<?php echo $form->textField($model,'editor_first_name',array('size'=>60,'maxlength'=>100,'class'=>'span3')); ?>
		<?php echo $form->error($model,'editor_first_name'); ?>
	</div>
        <br>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'editor_last_name'); ?>
		<?php echo $form->textField($model,'editor_last_name',array('size'=>60,'maxlength'=>100,'class'=>'span3')); ?>
		<?php echo $form->error($model,'editor_last_name'); ?>
	</div>
        <br>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'span3')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <br>
	<div class="row-fluid">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'FINISH' : 'Save',array('class'=>'btn btn-success span3')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
