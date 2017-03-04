<?php







?>
<h4>Provide your advertisement details here</h4>
<hr>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-request-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        //'clientOptions'=>array('validateOnSubmit'=>true),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'action'=>array('request/advertisement_final_submission'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row hidden">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row hidden">
		<?php echo $form->labelEx($model,'request_type'); ?>
		<?php echo $form->radioButtonList($model,'request_type',array("paper"=>"Paper","consultancy"=>"Consultancy","advertisement"=>"Advertisement"),array("style"=>"float:left;margin-left:50px;width:50px;height:25px;")); ?>
		<?php echo $form->error($model,'request_type'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'request_approval'); ?>
		<?php echo $form->textField($model,'request_approval',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'request_approval'); ?>
	</div>-->

        <div class="row">
		<?php echo $form->labelEx($model,'ad_image'); ?>            
                <?php echo $form->fileField($model, 'ad_image',array("style"=>'width:60%;'));  ?> 
            	<?php echo $form->error($model,'ad_image'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'advertisement_text'); ?>
		<?php echo $form->textArea($model,'advertisement_text',array("style"=>"width:60%;height:100px;")); ?>
		<?php echo $form->error($model,'advertisement_text'); ?>
	</div>
        <br>
        <br>
	<div class="row buttons">     
		<?php echo CHtml::submitButton("Send Request",array("class"=>"btn btn-success","style"=>"width:30%;")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

