<?php
/* @var $this EmailController */
/* @var $model Model_Email */

                     $this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array( // configurations per alert type
                            // success, info, warning, error or danger
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));
                 




$this->breadcrumbs=array(
	'Authors'=>array('author/authorpanel','email'=>Yii::app()->user->name),
        'Detail info'=>array("email/updatebyuser","email"=> Yii::app()->user->name),
);

//$this->menu=array(
//	array('label'=>'List Author', 'url'=>array('index')),
//	array('label'=>'Create Author', 'url'=>array('create')),
//	array('label'=>'View Author', 'url'=>array('view', 'id'=>$model->author_id)),
//	array('label'=>'Manage Author', 'url'=>array('admin')),
//);
?>

<h3>Updating <?php echo $model->email; ?>'s detail info</h3><hr>

<?php $this->renderPartial('update_form', array('model'=>$model)); ?>