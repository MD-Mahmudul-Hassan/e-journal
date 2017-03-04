<?php
/* @var $this LivechatController */
/* @var $model Model_LiveChat */
/* @var $form CActiveForm */

?>






<div class="row-fluid">
    
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            <?php $this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'CLOSE'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));
            ?>
            <h3 align="center">Live Chat Verification Gate</h3>
            <hr>
        </div>
        <div class="span2"></div>
    </div><br>
    <div class="row-fluid">
    <div class="span3"></div>
    <div class="view span6">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--live-chat-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        )); ?>
	<?php echo $form->errorSummary($model); ?>
        <br>
	<div class="row-fluid" align="center">
		<?php echo $form->labelEx($model,'chat_pass_code'); ?>
		<?php echo $form->textField($model,'chat_pass_code'); ?>
		<?php echo $form->error($model,'chat_pass_code'); ?>
	</div>
        <br>
	<div class="row-fluid" align="center">
		<?php echo CHtml::submitButton("Enter to Live Chat",array('class'=>'btn btn-large btn-success')); ?>
	</div>

    <?php $this->endWidget(); ?>
      
        
        
        
        
        
        
    </div>
    <div class="span3"></div>    
    </div>
    
    
    
</div>