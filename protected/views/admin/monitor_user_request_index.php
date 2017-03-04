<?php
/* @var $counter*/

$this->widget('ext.yiibooster.widgets.TbAlert', array(
                            'fade' => true,
                            'closeText' => '&times;', // false equals no close link
                            'events' => array(),
                            'htmlOptions' => array(),
                            'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'CLOSE'),
                            'warning' => array('closeText' => 'CLOSE'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));

$model=new Model_request;
$appending_paper='Paper Requests'." ( ".$counter1." )";
$appending_consultancy='Consultancy Requests'." ( ".$counter2." ) ";
$appending_ad='Advertisement Requests'." ( ".$counter3." ) ";

?>


<h3>User Request Monitoring Panel for: <?php echo strtoupper($request_type);?> </h3>

<?php
$this->widget('ext.yiibooster.widgets.TbButtonGroup', 
        array(
                'type'=>'info',
                'size'=>'large',
                'htmlOptions'=>array(''),
                'buttons'=>array(                    
                    array('label'=>$appending_paper,'url'=> CHtml::normalizeUrl(array('admin/user_request_monitor','_request_type'=>'paper'))),
                    array('label'=>$appending_consultancy,'url'=>CHtml::normalizeUrl(array('admin/user_request_monitor','_request_type'=>'consultancy'))),
                    array('label'=>$appending_ad,'url'=>CHtml::normalizeUrl(array('admin/user_request_monitor','_request_type'=>'advertisement'))),
             ),    
));
?>



<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'monitor_user_requests',
)); ?>


