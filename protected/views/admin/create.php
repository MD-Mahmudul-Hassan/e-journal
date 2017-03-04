<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Admin', 'url'=>array('index')),
	array('label'=>'Manage Admin', 'url'=>array('admin')),
);
?>

<h1>Create Admin</h1>
<h5>Important: You must create an email first, then fill up this form and submit. If you have not created an email, then go back to the admin panel and click on the Email button.</h5>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>