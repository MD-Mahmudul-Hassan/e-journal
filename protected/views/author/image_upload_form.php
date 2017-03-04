<?php
/* @var $this AuthorController */
/* @var $model Blob */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'author-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uploadedfile'); ?>
		<?php echo $form->fileField($model,'uploadedfile'); ?>
		<?php echo $form->error($model,'uploadedfile'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->