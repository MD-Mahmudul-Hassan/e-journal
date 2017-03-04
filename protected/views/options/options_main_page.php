<?php
/* @var $this OptionsController */
/* @var $model1 Model_options */
/* @var $model2 Model_options */
/* @var $model3 Model_options */
/* @var $ad_list  */



$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/adminpanel'),
        'Options'=>array('options/option_main'),
);

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
$this->widget('ext.ibutton.IButton');
$link1= CHtml::normalizeUrl(array('options/update','id'=>'10'));

?>
<script type="text/javascript">
        $(document).ready(function (){
              $(":checkbox").iButton();
        });
</script>



<h3>Options</h3><hr>

<div class="row-fluid">
    <div class="view span4 form">
            <?php $form=$this->beginWidget('CActiveForm', array(
             'id'=>'model-options-form',
             'enableAjaxValidation'=>false,
             'action'=>array('options/update','id'=>'10'),
              )); ?>

             <?php echo $form->errorSummary($model1); ?>
   
             <div class="row">
                     <?php echo $form->labelEx($model1,'option_target'); ?>
                     <?php echo $form->DropDownList($model1, 'option_target', array('Not needed'=>'Not needed',$ad_list),array('class'=>'span12')); ?>
                     <?php echo $form->error($model1,'option_target'); ?>
             </div>
             <div class="row">
                     <?php echo $form->labelEx($model1,'option_link'); ?>
                     <?php echo $form->textField($model1, 'option_link');?>
                     <?php echo $form->error($model1,'option_link'); ?>
             </div>

<!--             <div class="row">
                     <?php echo $form->labelEx($model1,'option_action_state'); ?>
                     <?php echo $form->checkBox($model1,'option_action_state',array('size'=>60,'maxlength'=>100)); ?>
                     <?php echo $form->error($model1,'option_action_state'); ?>
             </div>-->
             <br><h4><?php echo $model1->option_action_name ;?></h4><br>
             <div align="center">
             <?php
                            if($model1->option_target!='Not set')
                            {    
                                $path=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$model1->option_target;    
                                $image_url=  Yii::app()->assetManager->publish($path);
                                echo CHtml::image($image_url);
                            }
                            else
                            {
                                echo "<strong>Image not set</strong>";
                            }
             ?></div>
             
             <br><br>
             <div class="row buttons">
                     <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span12')); ?>
             </div>

     <?php $this->endWidget(); ?>
      </div>
    
    
        <div class="view span4 form">
            <?php $form=$this->beginWidget('CActiveForm', array(
             'id'=>'model-options-form',
             'enableAjaxValidation'=>false,
             'action'=>array('options/update','id'=>'11'),
              )); ?>

             <?php echo $form->errorSummary($model2); ?>
             
             <div class="row">
                     <?php echo $form->labelEx($model2,'option_target'); ?>
                     
                     <?php echo $form->error($model2,'option_target'); ?>
             </div>
            <div class="row">
                     <?php echo $form->labelEx($model2,'option_link'); ?>
                     <?php echo $form->textField($model2, 'option_link');?>
                     <?php echo $form->error($model2,'option_link'); ?>
             </div>


             <br><h4><?php echo $model2->option_action_name ;?></h4><br>
             <div align="center">   
                 <?php
                            if($model2->option_target!='Not set')
                            {    
                                $path=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$model2->option_target;    
                                $image_url=  Yii::app()->assetManager->publish($path);
                                echo CHtml::image($image_url);
                            }
                            else
                            {
                                echo "<strong>Image not set</strong>";
                            }
                ?>
              </div>
             <br><br>
             <div class="row buttons">
                     <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span12')); ?>
             </div>

     <?php $this->endWidget(); ?>
      </div>
    
    
      <div class="view span4 form">
            <?php $form=$this->beginWidget('CActiveForm', array(
             'id'=>'model-options-form',
             'enableAjaxValidation'=>false,
             'action'=>array('options/update','id'=>'12'),
              )); ?>

             <?php echo $form->errorSummary($model3); ?>
             
             <div class="row">
                     <?php echo $form->labelEx($model3,'option_target'); ?>
                     <?php echo $form->DropDownList($model3, 'option_target', array('Not needed'=>'Not needed',$ad_list),array('empty'=>'---Select image---','class'=>'span12')); ?>
                     <?php echo $form->error($model3,'option_target'); ?>
             </div>
             <div class="row">
                     <?php echo $form->labelEx($model3,'option_link'); ?>
                     <?php echo $form->textField($model3, 'option_link');?>
                     <?php echo $form->error($model3,'option_link'); ?>
             </div>

             <br><h4><?php echo $model3->option_action_name ;?></h4><br>
             <div align="center">
             <?php
                            if($model3->option_target!='Not set')
                            {    
                                $path=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$model3->option_target;    
                                $image_url=  Yii::app()->assetManager->publish($path);
                                echo CHtml::image($image_url);
                            }
                            else
                            {
                                echo "<strong>Image not set</strong>";
                            }
             ?></div>
             <br><br>
             <div class="row buttons">
                    <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span12')); ?>
             </div>

     <?php $this->endWidget(); ?>
      </div>
    
    
    

</div><hr>

<div class="row-fluid">
        
    <div class="row-fluid"><h4 align="center" style="font-family:'Roboto-Regular'; font-weight: 400;">Issue And Volume Number Setting</h4></div><hr>
    <div class="view span5">
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'model-options-form',
                    'enableAjaxValidation'=>false,
                    'action'=>array('options/update','id'=>'13'),
            )); ?>


                    <?php echo $form->errorSummary($model4); ?>
                    

                    <div class="row span12">
                            <?php echo 'Volume Number'; //$form->labelEx($model4,'option_target'); ?>
                            <?php echo $form->textField($model4,'option_target',array('style'=>'text-align:center;')); ?>
                            <?php echo $form->error($model4,'option_target'); ?>
                    </div>
                 
                    <div class="row span12">
                            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span4' )); ?>
                    </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->

        
    </div>
    <div class="span1"></div>
    <div class="view span5">
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'model-options-form',
                    'enableAjaxValidation'=>false,
                    'action'=>array('options/update','id'=>'14'),
            )); ?>


                    <?php echo $form->errorSummary($model5); ?>
                    

                    <div class="row span12">
                            <?php echo 'Issue Number'; //$form->labelEx($model4,'option_target'); ?>
                            <?php echo $form->textField($model5,'option_target',array('size'=>60,'maxlength'=>100),array('style'=>'text-align:center;')); ?>
                            <?php echo $form->error($model5,'option_target'); ?>
                    </div>
                 
                    <div class="row span12">
                            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span4' )); ?>
                    </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->

        
    </div>
    
 
        
    
</div>
    

