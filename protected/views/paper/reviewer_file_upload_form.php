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
                            'info' => array('closeText' => 'close'),
                            ),
                            ));
?>

<div class="row-fluid">
<h3>Upload your reviewed file here</h3>
<hr><br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-paper-form',
	//'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
        'action'=>array('paper/first_review'),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>


<!--  -----------------------------  paper doc or docx row ----------------------  -->
        <div class="row-fluid">
		<?php echo $form->labelEx($model,'paper_file',array('style'=>'')); ?><br>
		<?php echo $form->fileField($model,'paper_file',array('style'=>'')); ?>
		<?php echo $form->error($model,'paper_file'); ?>
                
	</div>

        <br><br>
         <div class="row-fluid">
                   <?php echo CHtml::submitButton('Send to the author',array('class'=>'btn btn-large btn-success')); ?>                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


