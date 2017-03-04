<?php

/* @var $this AuthorController */
/* @var $data Model_paper */



$this->breadcrumbs=array(
	'Author Panel'=>array('author/authorpanel'),
        'Paper Status'=>array('paperstatus','id'=>  Yii::app()->user->name),
       
);

$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'CLOSE'),
                            'info'=> array('closeText' => 'CLOSE'),
                            ),
                            ));


//$model2=new Model_paper;


?>


<div style="font-size:17px;line-height: 30px;" class="row-fluid">
    <div class="row-fluid" style="text-align: center;font-size: 20px;">STATUS OF MY SUBMITTED PAPERS<sup class="icon-info-sign tooltipster" title="Follow the instructions given under 'Paper Status' column in the table<br>for each paper. Once you have any updates from the Editor,<br>download the corrections by clicking on the download link.<br><br>DO NOT CHANGE THE FILE NAME OR THE FORMAT AFTER DOWNLOADING THE PAPER!"></sup></div><hr style="border-color: lightblue;">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'filter'=>null,
    'columns' => array(
        array(
            'header' => 'Paper Title',
            'name' => 'paper_title',            
        ),
        array(
            'header' => 'Paper Field',
            'name' => 'paper_field',            
        ),
        array(
            'header' => 'Paper Subject',
            'name' => 'paper_subject',
        ),
         array(
            'header' => 'Paper Status',
            'name' => 'paper_state',    
        ),
        array( 
            'header'=>'Feedback',
            'class' => 'CButtonColumn',
            'template' => '{Download}',
            'buttons' => array(
                'Download' => array('url' => '$this->grid->controller->createUrl("paper/feedback_paper_download",array("id"=>$data["paper_id"]))'),
            ),
        ),
    ),)
    );
?>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <hr style="border-color: lightblue;"><p align="center" style="font-size: 20px;">CORRECTED PAPER SUBMISSION PANEL<sup class="icon-info-sign tooltipster" title="Once you have clear instructions from the Editors,<br>upload the corrected papers through the file upload options given below.<br> PDF version is only required on the final submission."></sup> </p><hr style="border-color: lightblue;">
    </div>
            <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'model-paper-form',
                            //'enableAjaxValidation'=>true,
                           'enableClientValidation'=>false,
                           'htmlOptions' => array('enctype' => 'multipart/form-data'),
                           'action'=>array('author/paperstatus','id'=>  Yii::app()->user->name),
                      
                    )); ?>
                         <?php echo $form->errorSummary($model_paper); ?>
                        <div class="row-fluid">
                                <div class="span3">
                                        <?php echo $form->labelEx($model_paper,'paper_file',array('class'=>'tooltipster','title'=>"Before submitting, make sure that you have not changed the file name or the format")); ?>
                                        <?php echo $form->fileField($model_paper,'paper_file',array('class'=>'span12')); ?>
                                        <?php echo $form->error($model_paper,'paper_file'); ?>
                                </div>
                                <div class="span3">
                                        <?php echo $form->labelEx($model_paper,'paper_file_pdf'); ?>
                                        <?php echo $form->fileField($model_paper,'paper_file_pdf',array('class'=>'span12')); ?>
                                        <?php echo $form->error($model_paper,'paper_file_pdf'); ?>
                                </div>
                          </div>
                          <br>
                        <div class="row-fluid">
                            <div class="row">                                 
                                    <?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-success span2',)); ?>
                                    <?php //echo CHtml::resetButton('Reset',array('class'=>'btn btn-success span2',)); ?>
                            </div>
                          </div>
                    <?php $this->endWidget(); ?>
                    </div>
        </div>



