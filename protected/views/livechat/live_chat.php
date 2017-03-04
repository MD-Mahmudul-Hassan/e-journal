<?php
/* @var $this LivechatController */
/* @var $data Model_LiveChat */
/* @var $model CSqlDataProvider*/

        
?>


                
  
    
<div style="width: 95%;float:left;margin-top: .5%;padding: 1%;"> 
    <div style="width: 100%; ">
        <img src="<?php echo $data->profile_image_url; ?>" width="10%" style="float:left;color: #52CBDD;overflow: hidden;border-radius: 50px;border:2px solid lightskyblue;">
    </div>    
    <div style="font-family: tahoma;font-size:14px;float:left;width: 95%;line-height: 20px;padding:1%; text-align: justify;margin-left: 20px;">   
        <?php echo CHtml::encode($data->chat_message)."<br>";?>
    </div>
    <div style="float: left;width: 95%;color:lightgray;text-align: right;">
        <?php echo CHtml::encode($data->chat_time)." ".CHtml::encode($data->chat_date);?>
    </div>
</div>           
