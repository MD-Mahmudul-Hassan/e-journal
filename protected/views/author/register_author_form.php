<?php
/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */


$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));

//$model=new Author;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'author-register_author_form-form',
	//'enableAjaxValidation'=>TRUE,
        'enableClientValidation'=>true,
        'action'=>array('author/register_author'),
        
)); 

?>
        <h4>Welcome Author! Fill the fields below and verify your email that you have entered in the previous page</h4>
	
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <br><br>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'author_first_name'); ?>
		<?php echo $form->textField($model,'author_first_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'author_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_last_name'); ?>
		<?php echo $form->textField($model,'author_last_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'author_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->