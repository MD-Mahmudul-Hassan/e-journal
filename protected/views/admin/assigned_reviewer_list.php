<?php
$this->breadcrumbs=array(
    
           "Admin Panel"=>array("adminpanel"),
            "Reviewer Monitoring Panel"=>array("reviewer_monitor"),
        
        
);

$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));
?>



<h3><p class="icon-eye-open"></p>Reviewer Monitoring panel</h3>
<hr>

<div style="font-size:110%;">
<?php
   
   
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'filter'=>null,
    'columns' => array(
       
        array(
            'header' => 'Reviewer name',
            'name' => 'editor_last_name',                   
        ),
        array(
            'header' => 'Paper Title',
            'name' => 'paper_title',  
        ),
        array(
            'header' => 'Paper Field',
            'name' => 'paper_field',                   
        ),
        array(
            'header' => 'Feedback state',
            'name' => 'paper_state',  
        ),
         array(
                    'name'  => 'Check Inside',
                    'value' => "CHtml::link('Download',array('admin/feedback_paper_download_by_admin','id'=>\$data['paper_id']))",
                    'type'  => 'raw',
                    )
        
//        array(
//            'header' => 'Paper Subject',
//            'name' => 'paper_subject',
//            //'value'=>$data_in['paper_id'],
//        ),
        
//        array( 
//            'header'=>'Action',
//            'class' => 'CButtonColumn',
//            'template' => '{Download}',
//            'buttons' => array(
//                'Download' => array('url' => '$this->grid->controller->createUrl("paper/downloadbyeditor",array("id"=>$data["paper_id"]))'),
//            ),
//        ),
   
   
    ),)
    );
    
?>
</div>