<?php







$email=  Yii::app()->user->name;
$chat_code=$this->get_chat_code_of_the_current_user($email);



$dataProvider=new CActiveDataProvider('Model_LiveChat', 
                    array(
                    'criteria'=>array
                        (   //'with'=>array('email0'),
                            'condition'=>"chat_pass_code='$chat_code'",
                            //'join' => 'JOIN tbl_email em ON em.email=t.email',
                            'order'=>'chat_id desc',
                        ),                    
                     )  
                    ); 






echo '<script type="text/javascript"> setInterval("location.reload(true)",10000); </script>';

?>





<div class="row-fluid" style="">                
                    <?php 
                    $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'live_chat',
                    )); 
                    
                    ?>                
</div>