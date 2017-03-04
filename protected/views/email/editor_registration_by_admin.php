<?php
/* @var $this EmailController */
/* @var $model Model_Email */
/* @var $form CActiveForm */
?>


<div class="form row-fluid">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--email-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        'action'=>array('email/register'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
	<div class="row span3">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'span12')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <div class="span1"></div>
	<div class="row span3">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>300,'class'=>'span12')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        <div class="span1"></div>
	<div class="row span4">
		<?php echo $form->labelEx($model,'user_type'); ?>
		<?php echo $form->textField($model,'user_type',array('value'=>'Editor'),array('style'=>'padding:5px;font-size:14px;','class'=>'span12')); ?>
		<?php echo $form->error($model,'user_type'); ?>
	</div>
</div>
<div class="row-fluid">
        <div class="row span3">
		<?php echo $form->labelEx($model,'contact_no'); ?>
		<?php echo $form->textField($model,'contact_no',array('size'=>50,'maxlength'=>50,'class'=>'span12')); ?>
		<?php echo $form->error($model,'contact_no'); ?>
	</div>
        <div class="span1"></div>
        <div class="row span3">
		<?php echo $form->labelEx($model,'profile_image_holder'); ?>
		<?php echo $form->fileField($model,'profile_image_holder'); ?>
		<?php echo $form->error($model,'profile_image_holder'); ?>
	</div>
         
        
</div>
<div class="row-fluid">   
        <div class="row span3">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200,'class'=>'span12')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	
        <div class="span1"></div>
	
        
	<div class="row span3">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100,'class'=>'span12')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>
        <div class="span1"></div>
	<div class="row span4">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100,'class'=>'span12')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
</div>
<div class="row-fluid">        
	<div class="row span3">
		<?php echo $form->labelEx($model,'institution_name'); ?>
		<?php echo $form->textField($model,'institution_name',array('size'=>60,'maxlength'=>200,'class'=>'span12')); ?>
		<?php echo $form->error($model,'institution_name'); ?>
	</div>
         <div class="span1"></div>
	<div class="row span3">
		<?php echo $form->labelEx($model,'secret_question'); ?>
		<?php echo $form->textField($model,'secret_question',array('size'=>60,'maxlength'=>300,'class'=>'span12')); ?>
		<?php echo $form->error($model,'secret_question'); ?>
	</div>
         <div class="span1"></div>
	<div class="row span4">
		<?php echo $form->labelEx($model,'secret_answer'); ?>
		<?php echo $form->textField($model,'secret_answer',array('size'=>60,'maxlength'=>300,'class'=>'span12')); ?>
		<?php echo $form->error($model,'secret_answer'); ?>
	</div>
</div>
        <br>
	<div class="row-fluid">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'NEXT' : 'Save',array('class'=>'btn btn-large btn-success span3')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->