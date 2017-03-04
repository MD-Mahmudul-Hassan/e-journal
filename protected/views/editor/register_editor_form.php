<?php
/* @var $this Model_EditorController */
/* @var $model Model_Editor */
/* @var $form CActiveForm */
$model=new Model_Editor;



//$this->breadcrumbs=array(
//	'User Registration'=>array('site/page','view'=>'register_email'),
//        "Editor Form"=>array('site/page','view'=>'register_editor_form'),
//
//);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model--editor-register_editor_form-form',
	//'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>array('editor/register_editor'),
)); ?>
        <h1>Welcome Sir! Just one step more..</h1>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'editor_first_name'); ?>
		<?php echo $form->textField($model,'editor_first_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'editor_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'editor_last_name'); ?>
		<?php echo $form->textField($model,'editor_last_name',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'editor_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Finish',array('style'=>'width:150px;background:#28BAD0;color:white;font-size:17px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->