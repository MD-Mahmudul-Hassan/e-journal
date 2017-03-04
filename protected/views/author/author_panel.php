<?php
/* @var $this AuthorController */
/* @var $email */

$this->breadcrumbs=array(
	'Author Panel'=>array('authorpanel','email'=>  Yii::app()->user->name),
);
$notifier;
if($counting_notifications>0)
{
    $notifier='<sup class="notification_style">'.$counting_notifications.'</sup>';
}
else
{
    $notifier='';
}


$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));

?>


<div class="row-fluid">
    <div class="span12">
    <h3><p class="icon-check "></p>Authors Panel</h3>
            <div class="row-fluid btn-group">
                <?php echo CHtml::link('<p class="icon-upload icon-white"></p>Submit my Paper',Yii::app()->createUrl('/paper/create'),array("class"=>'btn btn-info tooltipster','title'=>'Send a fresh paper to admin to get reviewing approval'));?>
                <?php echo CHtml::link('<p class="icon-globe icon-white"></p>Paper Status',  Yii::app()->createUrl('author/paperstatus',array('id'=>  Yii::app()->user->name)),array("class"=>'btn btn-info tooltipster','title'=>'See your papers current status <br>and manage the reviewing process'));?>
                <?php echo CHtml::link('<p class="icon-flag icon-white"></p>Request',Yii::app()->createUrl('request/create',array('email'=>  Yii::app()->user->name)),array("class"=>'btn btn-info tooltipster','title'=>'Send requests to admin for a special paper, consultany<br>and advertisement'));?>
                <?php echo CHtml::link('<p class="icon-check icon-white"></p>My submitted requests',Yii::app()->createUrl('request/request_viewer_by_user',array('email'=>  Yii::app()->user->name)),array("class"=>'btn btn-info tooltipster','title'=>'Check admin responses regarding you requests'));?>
                <?php echo CHtml::link('<p class="icon-user icon-white"></p>Live Chat',Yii::app()->createUrl('livechat/code_checking_gate',array('image_url'=>$profile_image)),array("class"=>'btn btn-info tooltipster','target'=>'_blank','title'=>'Enter to the live chat panel'));?>
                <?php echo CHtml::link('<p class="icon-bell icon-white"></p>Notifications'.$notifier,Yii::app()->createUrl('author/author_notifications',array('email'=>  Yii::app()->user->name)),array("class"=>'btn btn-info tooltipster','title'=>'Stay up to date with latest notices'));?>
               
            </div>
    <div class="row-fluid"><hr></div>
    </div>

 </div>


<div class="author_holder_div row-fluid">
    <div class="span12" style="padding:10px;">
        <div class="span3" id="author_pic_holder">        
            <div class="row-fluid"><img  src="<?php echo $profile_image; ?>" width="100%" height="100%"/></div>
            <div class="row-fluid">  <?php //echo CHtml::link('Change',Yii::app()->createUrl('author/image_uploading'),array("class"=>'btn btn-info span12')); ?>
            
            <?php 
        $collapse = $this->beginWidget('ext.yiibooster.widgets.TbCollapse'); ?>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration: none;"  class="btn btn-info span12">
                                Change
                            </a>
                            </div>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse out" style="border:1px solid white;">
                            <div class="panel-body">
                                <div class="form">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                        'id'=>'admin-form',
                                        'enableAjaxValidation'=>false,
                                        'enableClientValidation'=>true,
                                        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                                        //'action'=>array('author/profile_image_update'),
                                        )); ?>              
                                    <?php echo $form->errorSummary($model); ?>
                                    <div class="row-fluid">
                                            <?php //echo $form->labelEx($model,'profile_image_holder'); ?>
                                            <?php echo $form->fileField($model, 'profile_image_holder');  ?>
                                            <?php echo $form->error($model,'profile_image_holder'); ?>
                                    </div>                                    
                                    <br>
                                    <div class="row-fluid">
                                        <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success span12')); ?>
                                    </div>
                                <?php $this->endWidget(); ?>                                
                                <hr>
                                </div>           
                            </div>
                        </div>
                    </div>
                      
                 </div>
               
                <?php $this->endWidget(); ?>
  
            </div>
        </div>
        <div class="span5">
            <p class="row-fluid" style="font-family: 'Roboto-Regular';font-size: 25px;line-height: 30px;text-align: center;">Welcome <?php echo $authors_full_name; ?></p> <br><br>
            <div class="row-fluid">
                <div class="span6" style="text-align: center;color:green;"><img src="images/user_status.jpg" wu="50px">&nbsp;Currently Online</div>
               <div class="span6" style="text-align: center;"><img src="images/member_since.jpg" width="50px">&nbsp;Member Since: <?php echo $author_since;?></div>
            </div>
        </div>
        <div class="span3" style="border-left:1px solid windowframe;">
            <div class="row-fluid"><?php  echo CHtml::link('<p class="icon-edit"></p>Update My General Info',Yii::app()->createUrl('author/updatebyauthor',array('email'=>Yii::app()->user->name)),array("class"=>'btn btn-danger span12'));?></div>
             <div class="row-fluid"><?php  echo CHtml::link('<p class="icon-edit"></p>Update MY Detailed Info',Yii::app()->createUrl('email/updatebyuser',array('email'=>Yii::app()->user->name)),array("class"=>'btn btn-danger span12'));?></div>
        </div>
    </div>
    <hr>
    <div class="row-fluid"> 
        <div class="span1"></div>
            <p style="margin-top: 15px;padding:10px;font-size: 19px;" align="center" class="span10">Citation Details</p>
        <div class="span1"></div>
    </div>
   
    <div class="row-fluid">        
        <div class="span1"></div>
         <div class="span10">       
                <div class="citation_divider view span4"><b>Published Papers</b><br><?php echo $total_published; ?></div>

                <div class="citation_divider view span4"><b>Total Viewed</b><br><?php echo $total_views; ?></div>

                <div class="citation_divider view span4"><b>Total Downloads</b><br><?php echo $total_downloads;?></div>       
        </div>
         <div class="span1"></div>
        
    </div>
    
    
    <br><br><br>
    <div class="row-fluid"> 
        <div class="span1"></div>
            <p style="margin-top: 15px;padding:10px;font-size: 19px;" align="center" class="span10">Citation of my published papers</p>
        <div class="span1"></div>
    </div>
    <div class="row-fluid">
        <div class="span1"></div>
        <div class="span10">
          <?php
             $this->widget('ext.yiibooster.widgets.TbGridView',
                    array(
                        'type' => 'bordered',
                        'dataProvider' => $citation_details,
                        'template' => "{items}",
                        'columns' => array(
                                    array(
                                        'header' => 'Paper Title',
                                        'name' => 'paper_title',         
                                    ),
                                    array(
                                        'header' => 'Downloaded',
                                        'name' => 'downloaded_full',         
                                    ),
                                    array(
                                        'header' => 'Viewed',
                                        'name' => 'viewed_full',         
                                    ),
                       
                                ))
            );

            ?>
        
        
        
        
        <?php

       // echo $data_in;

//         $this->widget('zii.widgets.grid.CGridView', array(
//         'id' => 'a-grid-id',
//         'dataProvider' => $citation_details,
//         'filter'=>null,
//         'columns' => array(
//             array(
//                 'header' => 'Paper Title',
//                 'name' => 'paper_title',  
//             ),
//             array(
//                 'header' => 'Paper Field',
//                 'name' => 'paper_field',                   
//             ),
//             array(
//                 'header' => 'Paper Subject',
//                 'name' => 'paper_subject',
//                 //'value'=>$data_in['paper_id'],
//             ),
//             array(
//                 'header' => 'Paper Status',
//                 'name' => 'paper_state',
//                 //'value'=>$data_in['paper_id'],
//             ),
//             array( 
//                 'header'=>'Doc/Docx',
//                 'class' => 'CButtonColumn',
//                 'template' => '{Download}',
//                 'buttons' => array(
//                     'Download' => array('url' => '$this->grid->controller->createUrl("paper/downloadbyeditor",array("id"=>$data["paper_id"]))'),
//                 ),
//             ),
//
//             array( 
//                 'header'=>'PDF',
//                 'class' => 'CButtonColumn',
//                 'template' => '{Download}',
//                 'buttons' => array(
//                     'Download' => array('url' => '$this->grid->controller->createUrl("editor/downloadpaperaspdf_by_editor",array("paper_title"=>$data["paper_title"]))'),
//                 ),
//             ),        
//
//
//         ),)
//         ); 
        
        ?>
        
        
        
<!--        <div class="span12" > 
            <div class="span1"></div>
            <div class="span10">
                <p style="padding:10px;background-color: #29a8bb;color:white;font-size: 19px;text-align: center;">My Published Papers</p>
                <?php
                foreach ($paper_names as $value) 
                {             
                    echo "<p style='font-size:17px;font-family:tahoma;background-color:offwhite;'>".$name=substr($value, 10, -5)."</p>";             
                }         
             ?>
             </div>
            <div class="span1"></div>
        </div>       -->
        </div>
        <div class="span1"></div>
    </div> <br>
</div>



