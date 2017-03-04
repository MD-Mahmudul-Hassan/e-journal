<?php
/* @var $this PaperController */
/* @var $model Model_paper */
/* @var $form CActiveForm */

                $this->widget('ext.yiibooster.widgets.TbAlert', array(
                            'fade' => true,
                            'closeText' => '&times;', // false equals no close link
                            'events' => array(),
                            'htmlOptions' => array(),
                            'userComponentId' => 'user',
                            'alerts' => array( // configurations per alert type
                            // success, info, warning, error or danger
                            'error' => array('closeText' => 'Close')
                            ),
                            ));
?>

<div class="row-fluid">

    <div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'model-paper-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            //'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array('validateOnSubmit'=>true),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>



            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'paper_title'); ?>
                    <?php echo $form->textField($model,'paper_title',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'paper_title'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'paper_field'); ?>
                    <?php echo $form->textField($model,'paper_field',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'paper_field'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'paper_subject'); ?>
                    <?php echo $form->textField($model,'paper_subject',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'paper_subject'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'issue_number'); ?>
                    <?php echo $form->textField($model,'issue_number',array('size'=>20,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'issue_number'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'volume_number'); ?>
                    <?php echo $form->textField($model,'volume_number',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'volume_number'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'acceptance_date'); ?>
                    <?php echo $form->textField($model,'acceptance_date'); ?>
                    <?php echo $form->error($model,'acceptance_date'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'paper_price'); ?>
                    <?php echo $form->textField($model,'paper_price',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'paper_price'); ?>
            </div>

            <div class="row-fluid">
                    <?php echo $form->labelEx($model,'paper_abstract'); ?>
                    <?php echo $form->textArea($model,'paper_abstract',array('size'=>60,'maxlength'=>500,'class'=>'span9','style'=>'height:150px;')); ?>
                    <?php echo $form->error($model,'paper_abstract'); ?>
            </div>

            <div class="row-fluid">                   
                    <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span3','style'=>'padding:5px;')); ?>                
            </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->


</div>

