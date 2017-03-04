<?php
/* @var $this PostblogController */
/* @var $data Model_blog */

$this->breadcrumbs=array(
	'Blog'=>array('index',),
);
?>

<div class="row-fluid">    
    <div class="comment_holder_div">       
                <div class="row-fluid">                                        
                       Posted by&nbsp;<b style="color:#28BAD0;"><?php echo CHtml::encode($data->user_name);?></b>&nbsp;&nbsp;On&nbsp;<?php echo "&nbsp;".CHtml::encode($data->comment_date)." at ".CHtml::encode($data->comment_time);?>
                       <hr>                        
                </div>           
       <div class="row-fluid">                        
                <?php            
                    echo CHtml::encode($data->comment_message);
                ?>          
       </div>
    </div>             
</div>

