<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h3>Login</h3>

<!--<p>Please fill out the following form with your login credentials:</p>-->

<div class="form" style="margin-bottom: 31px;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('style'=>'width:300px;border-radius:10px 10px 10px 10px;padding:5px;font-size:15px;')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('style'=>'width:300px;border-radius:10px 10px 10px 10px;')); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>
        <div class="row" >
            <p>Don't have an account yet? Register <?php echo CHtml::link("here", CHtml::normalizeUrl(array("email/register")));?></p>            
        </div>
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
        
	<div class="row buttons">
            <br><br>
		<?php echo CHtml::submitButton('Login',array('style'=>'width:150px;background:#28BAD0;color:white;font-size:15px;border:none;')); ?>
     
	</div>
       
        
        

<?php $this->endWidget(); ?>
        
</div><!-- form -->

