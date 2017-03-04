<?php


?>



<div class="row-fluid">
    <div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'model-paper-form',
            //'enableAjaxValidation'=>true,
           'enableClientValidation'=>true,
            //'clientOptions'=>array('validateOnSubmit'=>true),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

<!--            <div class="row hidden">
                    <?php echo $form->labelEx($model,'author_id'); ?>
                    <?php echo $form->textField($model,'author_id'); ?>
                    <?php echo $form->error($model,'author_id'); ?>
            </div>-->

    <!--	<div class="row">
                    <?php echo $form->labelEx($model,'citation_id'); ?>
                    <?php echo $form->textField($model,'citation_id'); ?>
                    <?php echo $form->error($model,'citation_id'); ?>
            </div>-->

            <div class="row">
                    <?php echo $form->labelEx($model,'paper_title'); ?>
                    <?php echo $form->textField($model,'paper_title',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'paper_title'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'paper_field'); ?>
                    <?php echo $form->textField($model,'paper_field',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'paper_field'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'paper_subject'); ?>
                    <?php echo $form->textField($model,'paper_subject',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'paper_subject'); ?>
            </div>


    <!--  -----------------------------  paper doc or docx row ----------------------  -->
<!--            <div class="row">
                    <?php echo $form->labelEx($model,'paper_file'); ?>
                    <?php echo $form->fileField($model,'paper_file',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'paper_file'); ?>
            </div>-->

<!--            <div class="row">
                    <?php echo $form->labelEx($model,'paper_file_pdf'); ?>
                    <?php echo $form->fileField($model,'paper_file_pdf',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'paper_file_pdf'); ?>
            </div>-->


       	    <div class="row">
                    <?php echo $form->labelEx($model,'issue_number'); ?>
                    <?php echo $form->textField($model,'issue_number',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'issue_number'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'volume_number'); ?>
                    <?php echo $form->textField($model,'volume_number',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'volume_number'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'acceptance_date'); ?>
                    <?php echo $form->textField($model,'acceptance_date'); ?>
                    <?php echo $form->error($model,'acceptance_date'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'paper_price'); ?>
                    <?php echo $form->textField($model,'paper_price',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'paper_price'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'paper_abstract'); ?>
                    <?php echo $form->textArea($model,'paper_abstract',array('size'=>60,'maxlength'=>500,'style'=>'height:200px;','class'=>'span7')); ?>
                    <?php echo $form->error($model,'paper_abstract'); ?>
            </div>

            <div class="row span7">
                    <?php echo CHtml::resetButton('Reset',array('class'=>'btn btn-info span3','style'=>'padding:5px;float:left;')); ?>
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class'=>'btn btn-success span3','style'=>'padding:5px;float:right;')); ?>

            </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>
