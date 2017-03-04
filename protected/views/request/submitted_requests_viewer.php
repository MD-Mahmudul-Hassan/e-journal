<?php
/* @var $model CSqlDataProvider*/
/* @var $model2 Model_request*/
?>




<h3>Request Viewer</h3>
<hr>
<h4>Enter the code given by admin to download a paper:</h4>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-paper-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'action'=>array('paper/secured_download_paper'),
)); ?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php //echo $form->labelEx($model2,'requested_paper_name'); ?>
		<?php echo $form->textField($model2,'request_approval'); ?>
		<?php echo $form->error($model2,'request_approval'); ?>
	</div>
        

	<div class="row">
		<?php //echo CHtml::resetButton('Reset',array('class'=>'btn btn-info','style'=>'width:200px;padding:5px;float:left;')); ?>
                <?php echo CHtml::submitButton('Download via secure line',array('class'=>'btn btn-success','style'=>'width:200px;')); ?>
                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->





<hr>
 <?php
  
  // echo $data_in;
   
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'filter'=>null,
    'columns' => array(
        array(
            'header' => 'Request Type',
            'name' => 'request_type',  
        ),
        array(
            'header' => 'Looking For',
            'name' => 'request_subject',                   
        ),
        array(
            'header' => 'Approval',
            'name' => 'request_approval',
            //'value'=>$data_in['paper_id'],
        ),
//        array( 
//            'header'=>'Action',
//            'class' => 'CButtonColumn',
//            'template' => '{Download}',
//            'buttons' => array(
//                'Download' => array('url' => '$this->grid->controller->createUrl("paper/downloadbyeditor",array("id"=>$data["paper_id"]))'),
//            ),
//        ),
   
   
    ),)
    );
    
?>