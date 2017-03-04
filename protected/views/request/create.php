<?php
/* @var $this RequestController */
/* @var $model Model_request */

$this->breadcrumbs=array(
	'Model Requests'=>array('index'),
	'Create',
);
$this->widget('ext.yiibooster.widgets.TbAlert', array(
                            'fade' => true,
                            'closeText' => '&2;', // false equals no close link
                            'events' => array(),
                            'htmlOptions' => array(),
                            'userComponentId' => 'user',
                            'alerts' => array( // configurations per alert type
                            // success, info, warning, error or danger
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'close'),
                            ),
                            ));
//$this->menu=array(
//	array('label'=>'List Model_request', 'url'=>array('index')),
//	array('label'=>'Manage Model_request', 'url'=>array('admin')),
//);
?>

<div class="row-fluid">
    
    <div class="row-fluid"><h4>Fill up the form with your request credentials</h4></div>
<hr>
<div class="row-fluid">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

</div>