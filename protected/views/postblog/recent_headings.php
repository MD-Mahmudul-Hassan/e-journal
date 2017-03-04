<?php

/* @var $this PostblogController */
/* @var $model Model_blog */


$this->breadcrumbs=array(
	'Blog'=>array('index',),
        'Archive'=>array('postblog/postsearch','id'=>$model->comment_date),
       
);

      
    

?>



<div id="blog_container">
    <div style="display: none;">
        <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
//                'attributes'=>array(
//                        'admin_id',
//                        'admin_first_name',
//                        'admin_last_name',
//                        'email',
//                ),
        )); 
       
        
        
        ?>
     </div>
    <div>
    <?php 
            //echo $model->comment_date;
                        
            $target=$model->comment_date;            
            $target_len=  strlen($target);            
            $target_set=  substr($target,0,$target_len);  //<----------Date selection algorithm-----------------
            //echo $target_set;            
            //if($target==='2015-01-21') $target_set='2015-01-%';
                        
            $connection= Yii::app()->db;                                        
            $sql="SELECT * FROM tbl_blog WHERE comment_date like '$target_set%'";
            $command= $connection->createCommand($sql);           
            $data=$command->query();
                            
                while(($row=$data->read())!==false)
                {
                     echo " <div class='comment_holder_div'>";
                     echo       "<div class='comment_header_div'>";
                     echo           "<p style='font-family: tahoma;font-size: 18px;color:black;line-height: 25px;'>";
                                        //echo $row['comment_heading'];
                     echo               "<div class='datetime'>";
                                            echo "Posted by&nbsp;<b style='color:#28BAD0;'>"; 
                                            echo $row['email']; 
                                            echo "</b>&nbsp;On&nbsp;"; 
                                            echo strrev($row['comment_time']) ; 
                                            echo "&nbsp;"; echo $row['comment_date'];
                             echo       "</div>";   
                      echo          "</p><hr style='margin-bottom: 0px;'>"   ;           

                       echo      "</div>";
                       echo      "<div class='comment_message_div'>";            
                                        echo $row['comment_message'];
                               // echo CHtml::encode($data->comment_message);
                                     
                      echo       "</div>
                           </div>";
                }
            
//            
//            
//            if($command->execute())
//            {
//                $this->redirect(array('response/urgent'));
//            }
//            else 
//            {
//                echo "Could not response due to inapropriate data";
//                
//            }
//    
    
    ?>
   </div>
</div>


<div id="recent_post_container">  
    <div id="recent_header">
        Archive
    </div>
    <div id="recent_header_data_container"> 
        <?php 
        $url=  CHtml::normalizeUrl(array('site/page','view'=>'about'))    ;
        $collapse = $this->beginWidget('ext.yiibooster.widgets.TbCollapse'); ?>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration: none;">
                                Year-2016
                            </a>
                            </h4>
                        </div>
                    <div id="collapseOne" class="panel-collapse collapse out">
                        <div class="panel-body" style="margin-left: 20px;">
                                No Topics yet
                        </div>
                    </div>
                    </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_2015" style="text-decoration: none;">
                            Year-2015
                        </a>
                        </h4>
                    </div>
                <div id="collapse_2015" class="panel-collapse collapse">
                    <div class="panel-body">                                                   
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-12-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    December
                                                </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-11-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    November
                                                </a>   
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-10-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    October
                                                </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-09-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                   September
                                                </a>  
                        
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-08-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                   August
                                                </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-07-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    July
                                                </a> 
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-06-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    June
                                                </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-05-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    May
                                                </a>   
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-04-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    April
                                                </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-03-'));;?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    March
                                                </a> 
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-02-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    February
                            </a>
                            <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-01-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    January
                            </a>                                                                                                   
                    </div>
                </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"style="text-decoration: none;">
                            Year-2014
                        </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body" style="margin-left: 20px;">
                       Development began
                    </div>
                    </div>
                </div>
                </div>
    <?php $this->endWidget(); ?>
    </div>
    
    </div>  

