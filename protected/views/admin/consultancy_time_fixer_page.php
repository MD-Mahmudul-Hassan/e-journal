<?php
/* @var $this AdminController */
/* @var $model Model_request */
/* @var $form TbCActiveForm */






 $this->widget('ext.yiibooster.widgets.TbAlert', array(                            
                            'fade' => true,
                            'closeText' => '&times;', // false equals no close link
                            'events' => array(),
                            'htmlOptions' => array(),
                            'userComponentId' => 'user',
                            'alerts' => array( // configurations per alert type
                            // success, info, warning, error or danger
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'close;'),
                            ),
                            ));
          
                
?>


<div class="row-fluid">
     <h3>Online Chat Fixing Panel</h3>
        <hr><br>
    <div class="span4"></div>
        <div class="span7">    
       
            <?php $form=$this->beginWidget('ext.yiibooster.widgets.TbActiveForm', array(
                'id'=>'model-request-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                //'action'=>array('request/type_selector'),
        )); ?>

                <?php echo $form->errorSummary($model); ?>

        <!--	<div class="row">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'email'); ?>
                </div>-->
        <!--
                <div class="row">
                        <?php echo $form->labelEx($model,'request_type'); ?>
                        <?php echo $form->textField($model,'request_type',array("paper"=>"Paper","consultancy"=>"Consultancy","advertisement"=>"Advertisement"),array("style"=>"float:left;margin-left:50px;width:55px;height:25px;")); ?>
                        <?php echo $form->error($model,'request_type'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'request_subject'); ?>
                        <?php echo $form->textField($model,'request_subject',array("style"=>"width:50%;")); ?>
                        <?php echo $form->error($model,'request_subject'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'request_message'); ?>
                        <?php echo $form->textArea($model,'request_message',array("style"=>"width:100%;height:200px;")); ?>
                        <?php echo $form->error($model,'request_message'); ?>
                </div>-->

                <div class="row-fluid">
                    <h4>Select a date:</h4>
                        <?php
                            $this->widget('ext.yiibooster.widgets.TbDatePicker',
                                            array(
                                            'model' => $model,
                                            'attribute'=>'chat_date',
                                                )
                                         );            
                        ?>
                </div>
                <div class="row-fluid">
                        <?php                    
                            echo $form->timepickerRow($model,'chat_time');
                        ?>
                </div>

                <div class="row-fluid">
                        <?php echo $form->labelEx($model,'chat_expert_editor'); ?>
                        <?php echo $form->dropDownList($model,'chat_expert_editor',$editors_list,array('empty'=>'Select An Expert')); ?>
                        <?php echo $form->error($model,'chat_expert_editor'); ?>
                </div>

                <div class="row-fluid hidden">
                        <?php echo $form->labelEx($model,'request_approval'); ?>
                        <?php echo $form->textField($model,'request_approval',array('size'=>50,'maxlength'=>200)); ?>
                        <?php echo $form->error($model,'request_approval'); ?>
                </div>
                <br>
                <div class="row-fluid buttons">
                        <?php //echo CHtml::resetButton("Reset",array("class"=>"btn btn-info","style"=>"width:150px;")); ?>
                        <?php echo CHtml::submitButton("Confirm Chat",array("class"=>"btn btn-success","style"=>"width:200px;")); ?>
                </div>

        <?php $this->endWidget(); ?>


           </div>     
        
</div>