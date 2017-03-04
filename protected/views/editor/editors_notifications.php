<?php



?>



<div class="row-fluid">
    
    <div class="row-fluid"><h4 align="center">Important Notifications</h4></div><hr>
    <div class="row-fluid" style="font-size: 16px;line-height: 30px;">
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'a-grid-id',
         'dataProvider' => $model,
         'filter'=>null,
         'columns' => array(
             array(
                 'header' => 'Notification Received',
                 'name' => 'notification_date',
             ),
             array(
                 'header' => 'Message',
                 'name' => 'notification_message',                   
             ),
             array(
                 'header' => 'Message Seen',
                 'name' => 'notification_seen',                   
             ),
             array( 
                 'header'=>'Action',
                 'class' => 'CButtonColumn',
                 'template' => '{Seen}',
                 'buttons' => array(
                     'Seen' => array('url' => '$this->grid->controller->createUrl("editor/notification_seen",array("id"=>$data["notification_id"]))'),
                 ),
             ),
//             array(
//                 'header' => 'Paper Subject',
//                 'name' => 'paper_subject',
//                 //'value'=>$data_in['paper_id'],
//             ),
//             array(
//                 'header' => 'Paper Status',
//                 'name' => 'paper_state',
//                 //'value'=>$data_in['paper_id'],
//                  ),
             
            


         ),)
         );         
        ?>

        </div>
    
    
    
    
    
</div>







