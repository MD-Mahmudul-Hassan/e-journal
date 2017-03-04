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
                            'alerts' => array( 
                            'error' => array('closeText' => 'Close'),
                                 'success' => array('closeText' => 'close'),
                            ),
                            ));
?>

<div class="form col-md-12 col-xs-12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-paper-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
        'action'=>array('editor/accept_paper'),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

        <h3>Select the File to Accept for publication:</h3><br><br>
        <p>Note: File name must remain same as the time when downloaded first</p>
        <hr>
        
        <br>
	<?php echo $form->errorSummary($model); ?>


<!--  -----------------------------  paper doc or docx row ----------------------  -->
        <div class="row">
             
		<?php echo $form->labelEx($model,'paper_file'); ?>
		<?php echo $form->fileField($model,'paper_file',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'paper_file'); ?>
	</div>


	<div class="row">
		<?php //echo CHtml::resetButton('Reset',array('class'=>'btn  btn-info','style'=>'width:200px;padding:5px;float:left;')); ?>
                <?php echo CHtml::submitButton('Accept',array('class'=>'btn btn-success','style'=>'width:200px;height:50px;padding:5px;float:left;font-size:20px;')); ?>
                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


