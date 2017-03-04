<?php
/* @var $model Model_request */










$condition= new CDbCriteria;
$condition->condition="paper_state='Paper Accepted'";
$models = Model_paper::model()->findAll($condition);
$list = CHtml::listData($models,'paper_title','paper_title');



//echo $model->request_type;

?>

<h3>Select the paper your require</h3>
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
        'action'=>array('request/request_final_submission'),
)); ?>


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

	<div class="row">
		<?php echo $form->labelEx($model,'request_subject'); ?>
		<?php echo $form->DropDownList($model, 'request_subject', $list,array('empty'=>'-Select a paper-')); ?>
		<?php echo $form->error($model,'request_subject'); ?>
	</div>

	<div class="row hidden">
		<?php echo $form->labelEx($model,'request_message'); ?>
		<?php echo $form->textArea($model,'request_message',array("style"=>"width:100%;height:200px;")); ?>
		<?php echo $form->error($model,'request_message'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'request_approval'); ?>
		<?php echo $form->textField($model,'request_approval',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'request_approval'); ?>
	</div>-->
<!--
        <div class="row">
		<?php echo $form->labelEx($model,'requested_paper_name'); ?>
                <?php echo $form->DropDownList($model, 'requested_paper_name', $list,array('empty'=>'Select'));  ?>                                       
		<?php //echo $form->textField($model,'requested_paper_name',array("style"=>"width:70%;")); ?>
            	<?php echo $form->error($model,'requested_paper_name'); ?>
	</div>-->
        
<!--        <div class="row">
		<?php echo $form->labelEx($model,'requested_paper_issue_number'); ?>
		<?php echo $form->textField($model,'requested_paper_issue_number',array("style"=>"width:20%;")); ?>
		<?php echo $form->error($model,'requested_paper_issue_number'); ?>
	</div>-->
        
        <br><br><br>

	<div class="row buttons">    
		<?php echo CHtml::submitButton("Send Request",array("class"=>"btn btn-success","style"=>"width:30%;")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->