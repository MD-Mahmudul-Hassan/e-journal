<?php
/* @var $this LivechatController */
/* @var $dataProvider CSqlDataProvider */
 





$this->widget('ext.yiibooster.widgets.TbAlert', array(
                            'alerts'=> array(
                            'success',
                            'warning',
                            'error',
                            ),
                            ));



    
    
   // echo '<script type="text/javascript"> setInterval("location.reload(true)",5000); </script>';
        
                         
          
          
    




?>

<script type="text/javascript">
    function reloader()
    {
            setInterval("location.reload()",2000);              
    }  
</script>

<button onclick="reloader()">
     <?php echo CHtml::link('Iframe',Yii::app()->createUrl('livechat/iframe_testing'),array("class"=>'btn btn-danger'));?>
</button>

<div class="row-fluid">
    <hr>
    <div class="row-fluid">
        <div class="span3"></div>
        <div class="span6" style="border-left:1px solid lightgray;">
            <div class="row span12" id="chat_bar">
                <div class="span10" >Live Consultancy</div>
                <div class="span2">
                    <?php   
                            $this->widget('ext.yiibooster.widgets.TbMenu',
                             array(
                            'type' => 'navbar',
                            'items' => array(
                                array(
                                    'label' => 'Options',
                                    'items' => array(
                                        array('label' => 'Clear My comments only', 'url' =>  CHtml::normalizeUrl(array('livechat/clear_user_chat_history','image_url'=>$image_url))),
                                        array('label' => 'Clear All History', 'url' =>  CHtml::normalizeUrl(array('livechat/Clear_all_chat_history','image_url'=>$image_url))),
                  
                                    )
                                ),
                            )));        
                      ?>      
                </div>
            </div>
            <div class="row-fluid" style="height:300px;overflow:hidden;">
                
                <iframe src="<?php echo Yii::app()->createUrl('livechat/iframe_testing'); ?>" width="100%" height="100%" style="overflow:scroll;"></iframe>
                <?php 
                
                    
                    //$this->renderPartial('iframe_testing_for_chat');
                
                ?>
                    <?php 
//                    $this->widget('zii.widgets.CListView', array(
//                            'dataProvider'=>$dataProvider,
//                            'itemView'=>'live_chat',
//                    )); 
                    ?>                
            </div>
            </div> 
     
        <div class="span3"></div>                     
    </div>  
    
    <div class="row-fluid">
        <div class="span3"></div>
        <div class="span6">
            
            <div class="row-fluid" style="height:60px;">
                <div class="form">    
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'model--live-chat-form',
                        'enableAjaxValidation'=>false,
                        'action'=>array('livechat/live_chat_panel','image_url'=>$image_url),
                )); ?>
                        <?php echo $form->errorSummary($model); ?>  
                        <div class="row">
                                <?php //echo $form->labelEx($model,'chat_message'); ?>
                                <?php echo $form->textArea($model,'chat_message',array('class'=>'span12','style'=>'height:30px;')); ?>
                                <?php echo $form->error($model,'chat_message'); ?>
                                
                        </div>
                        <div class="row">
                                <?php echo CHtml::submitButton("Send",array('class'=>'btn btn-success span3','style'=>'height:30px;')); ?>
                        </div>
                 <?php $this->endWidget(); ?>
            </div>    
  
        </div>
            
            
            
            
        </div>
        <div class="span3"></div>
        
        
        
    </div>
    
</div>