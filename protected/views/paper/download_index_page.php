<?php
/* @var $this PaperController */
/* @var $data CActiveDataProvider */
/* @var $model Model_paper */
$this->breadcrumbs=array(
	'Model Papers',
);

//$this->menu=array(
//	array('label'=>'Create Model_paper', 'url'=>array('create')),
//	array('label'=>'Manage Model_paper', 'url'=>array('admin')),
//);


 $this->widget('ext.yiibooster.widgets.TbAlert', array(
                            'fade' => true,
                            'closeText' => '&times;', // false equals no close link
                            'events' => array(),
                            'htmlOptions' => array(),
                            'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'close'),
                            ),
                            ));

    $ad_image_1;
    $ad_text_1;
    $ad_image_2;
    $ad_text_2;
    $ad_image_3;
    $ad_text_3;
    $ad_link1;
    $ad_link2;
    $ad_link3;
    
    $connection= Yii::app()->db;
    
    $data1=  Model_options::model()->findAllByPk('10');
    $data2=  Model_options::model()->findAllByPk('11');
    $data3=  Model_options::model()->findAllByPk('12');
   
    $temp1=  CHtml::listData($data1, 'option_target', 'option_details');
    $temp2=  CHtml::listData($data2, 'option_target', 'option_details');
    $temp3=  CHtml::listData($data3, 'option_target', 'option_details');
    
    
    
    foreach ($temp1 as $key=>$value) {
        $ad_image_1=$key;
        $ad_text_1=$value;
    }
    foreach ($temp2 as $key=>$value) {
        $ad_image_2=$key;
        $ad_text_2=$value;
    }
    foreach ($temp3 as $key=>$value) {
        $ad_image_3=$key;
        $ad_text_3=$value;
    }
    
    $temp1=  CHtml::listData($data1, 'option_link', 'option_link');
    $temp2=  CHtml::listData($data2, 'option_link', 'option_link');
    $temp3=  CHtml::listData($data3, 'option_link', 'option_link');
    foreach ($temp1 as $key=>$value) { $ad_link1=$value;}
    foreach ($temp2 as $key=>$value) { $ad_link2=$value;}
    foreach ($temp3 as $key=>$value) { $ad_link3=$value;}
       
    $path1=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$ad_image_1;
    $path2=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$ad_image_2;
    $path3=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$ad_image_3;
    $image_url1=  Yii::app()->assetManager->publish($path1);
    $image_url2=  Yii::app()->assetManager->publish($path2);
    $image_url3=  Yii::app()->assetManager->publish($path3);


?>

    
    
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid"><h2>Published Papers</h2></div><hr>
        <div class="row-fluid">            
            <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'model-paper-form',
                            //'enableAjaxValidation'=>true,
                           'enableClientValidation'=>false,
                      
                    )); ?>
                         <?php echo $form->errorSummary($model); ?>
                        <div class="row-fluid">
                                <div class="span3">
                                        <?php echo $form->labelEx($model,'paper_title'); ?>
                                        <?php echo $form->textField($model,'paper_title',array('class'=>'span12')); ?>
                                        <?php echo $form->error($model,'paper_title'); ?>
                                </div>
                            
                                 <div class="span1"></div>
                                 <div class="span2">
                                        <?php echo $form->labelEx($model,'paper_field'); ?>
                                        <?php echo $form->DropDownList($model,'paper_field',$fields); ?>
                                        <?php echo $form->error($model,'paper_field'); ?>
                                </div>
                                 <div class="span1"></div>
                                 <div class="span2">
                                        <?php echo $form->labelEx($model,'volume_number'); ?>
                                        <?php echo $form->textField($model,'volume_number',array('class'=>'span12')); ?>
                                        <?php echo $form->error($model,'volume_number'); ?>
                                </div>
                                  <div class="span1"></div>
                                <div class="span2">
                                        <?php echo $form->labelEx($model,'issue_number'); ?>
                                        <?php echo $form->textField($model,'issue_number',array('class'=>'span12')); ?>
                                        <?php echo $form->error($model,'issue_number'); ?>
                                </div>
                          </div>
                        <div class="row-fluid">
                            <div class="row">                                 
                                    <?php echo CHtml::submitButton('Filter Search',array('class'=>'btn btn-success span2',)); ?>
                                    <?php //echo CHtml::resetButton('Reset',array('class'=>'btn btn-success span2',)); ?>
                            </div>
                          </div>
                    <?php $this->endWidget(); ?>
                    </div>
        </div>
                
   <hr>
    </div>
    

        <div class="row-fluid">
             
        <div class="span7">
                <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'paper_download_page',
                )); ?>
         </div>
            <div class="span1"></div>
            <div class="span4" style="margin-top: 4%;">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span12">                                        
                            <a href="<?php echo "https://".$ad_link1;?>" target="_blank"><img src="<?php echo $image_url1;?>" width='100%' height='100%' ></a>                    
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="view span12">
                            <?php echo $ad_text_1;?>   
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <a href="<?php echo "https://".$ad_link2;?>" target="_blank"><img src="<?php echo $image_url2;?>" width='100%' height='100%' ></a> 
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="view span12">
                            <?php echo $ad_text_2;?>   
                        </div>
                    </div> 
                    <div class="row-fluid">
                        <div class="span12">
                            <a href="<?php echo "https://".$ad_link3;?>" target="_blank"><img src="<?php echo $image_url3;?>" width='100%' height='100%' ></a> 
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="view span12">
                            <?php echo $ad_text_3;?>   
                        </div>
                    </div>



               </div>


            </div>    

        </div>


</div>