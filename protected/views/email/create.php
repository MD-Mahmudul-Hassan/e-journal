<?php
/* @var $this EmailController */
/* @var $model Model_Email */




//$this->breadcrumbs=array(
//	'Emails'=>array('index'),
//	'Create',
//);

//$this->menu=array(
//	array('label'=>'List Model_Email', 'url'=>array('index')),
//	array('label'=>'Manage Model_Email', 'url'=>array('admin')),
//);
$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'CLOSE'),
                            'info' => array('closeText' => 'CLOSE'),
                            ),
                            ));
?>


<div class="row-fluid">

<h4>Registration Form</h4>
<hr>
<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

</div>