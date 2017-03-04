<?php
/* @var $this NewsController */
/* @var $data Model_News */

?>





<div class="row-fluid">
    <div class="row-fluid" style="border-bottom: 3px solid #28BAD1; text-align: justify;">
        <p style="font-size:25px;"><?php echo CHtml::encode($data->news_heading); ?></p>
        <p><?php echo "<b>Date: </b>".CHtml::encode($data->news_date)."<b> Time:</b>".CHtml::encode($data->news_time); ?></p>
        
    </div>
    <br>
    <div class="row-fluid" style="font-size: 16px; text-align: justify;">
        <?php echo CHtml::encode($data->news_body); ?>
    </div>
</div><hr><br>