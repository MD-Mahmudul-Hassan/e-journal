<?php
/* @var $this EditorController */
/* @var $data Model_paper */
/* @var $model_email Model_Email */
/* @var $model CSqlDataProvider*/

$this->breadcrumbs=array(
	'Editors Panel'=>array('editorspanel'),
);


$this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array( 
                            'success' => array('closeText' => 'close'),
                            'error' => array('closeText' => 'CLOSE'),
                            'warning' => array('closeText' => 'CLOSE'),
                            ),
                            ));

$notifier;
if($counting_notifications>0)
{
    $notifier='<sup class="notification_style">'.$counting_notifications.'</sup>';
}
else
{
    $notifier='';
}





?>

<h3><p class="icon-check "></p>Editors Panel</h3>

<div class="row-fluid btn-group">   
        <?php echo CHtml::link('<p class="icon-upload icon-white"></p>Upload my reviewed file',Yii::app()->createUrl('/paper/reviewer_upload_form'),array("class"=>'btn btn-info'));?>
        <?php echo CHtml::link('<p class="icon-ok icon-white"></p>Ask an Author to submit the final copy',Yii::app()->createUrl('editor/accept_paper'),array("class"=>'btn btn-info'));?>
        <?php echo CHtml::link('<p class="icon-user icon-white"></p>Live Chat',Yii::app()->createUrl('livechat/code_checking_gate',array('image_url'=>$profile_image)),array("class"=>'btn btn-info','target'=>'_blank'));?>
        <?php echo CHtml::link('<p class="icon-bell icon-white"></p>Notifications'.$notifier,Yii::app()->createUrl('editor/editor_notifications',array('email'=>  Yii::app()->user->name)),array("class"=>'btn btn-info'));?>
    <hr>
</div>

<?php

//$linking=CHtml::link('Open Review Panel');
//$this->widget(
//    'ext.yiibooster.widgets.TbTabs',
//    array(
//        'type' => 'tabs', // 'tabs' or 'pills'
//        'placement'=>'left',
//        'tabs' => array(
//            array(
//                'label' => 'Home',
//                'content' =>"<div class='span-6'>Click to open the Review panel<div class='btn btn-default'>$linking</div></div>",
//                'active' => true
//            ),
//            array('label' => 'Profile', 'content' => 'Profile Content'),
//            array('label' => 'Messages', 'content' => 'Messages Content'),
//        ),
//    )
//);
?>


<br>
<div class="row-fluid">
    <div class="view row-fluid">
        <div class="span3">
                <div class="row-fluid"><img  src="<?php echo $profile_image; ?>" width="100%" height="100%"></div>
                <div class="row-fluid">                    
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
                                    <?php echo $form->errorSummary($model_email); ?>
                                    <div class="row-fluid">
                                            <?php //echo $form->labelEx($model,'profile_image_holder'); ?>
                                            <?php echo $form->fileField($model_email, 'profile_image_holder');  ?>
                                            <?php echo $form->error($model_email,'profile_image_holder'); ?>
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
        <div class="span6">
            <div class="row-fluid"><p style="font-family:'Roboto-Regular';font-size: 25px;line-height: 30px;text-align: center;">Welcome <?php echo $editors_full_name;?></p></div>
            <br><br>
            <div class="row-fluid">
                <div class="span6" style="text-align: center;color:green;"><img src="images/user_status.jpg">&nbsp;Currently Online</div>
                <div class="span6" style="text-align: center;"><img src="images/member_since.jpg" width="50px">&nbsp;Member Since:<?php echo $editor_since;?></div><hr>
            </div>
            
        </div>
        <div class="span3">
             <div class="row-fluid"><?php  echo CHtml::link('Update My General Profile',Yii::app()->createUrl('editor/updatebyeditor',array('email'=>Yii::app()->user->name)),array("class"=>'btn btn-danger span12'));?></div>
             <div class="row-fluid"><?php  echo CHtml::link('Update MY Detailed Profile',Yii::app()->createUrl('email/updatebyuser',array('email'=>Yii::app()->user->name)),array("class"=>'btn btn-danger span12'));?></div>
        </div>
    </div>
       

   <div id="assigned_paper_list" class="row-fluid">
        <?php

       // echo $data_in;

         $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'a-grid-id',
         'dataProvider' => $model,
         'filter'=>null,
         'columns' => array(
             array(
                 'header' => 'Paper Title',
                 'name' => 'paper_title',  
             ),
             array(
                 'header' => 'Paper Field',
                 'name' => 'paper_field',                   
             ),
             array(
                 'header' => 'Paper Subject',
                 'name' => 'paper_subject',
                 //'value'=>$data_in['paper_id'],
             ),
             array(
                 'header' => 'Paper Status',
                 'name' => 'paper_state',
                 //'value'=>$data_in['paper_id'],
             ),
             array( 
                 'header'=>'Doc/Docx',
                 'class' => 'CButtonColumn',
                 'template' => '{Download}',
                 'buttons' => array(
                     'Download' => array('url' => '$this->grid->controller->createUrl("paper/downloadbyeditor",array("id"=>$data["paper_id"]))'),
                 ),
             ),

             array( 
                 'header'=>'PDF',
                 'class' => 'CButtonColumn',
                 'template' => '{Download}',
                 'buttons' => array(
                     'Download' => array('url' => '$this->grid->controller->createUrl("editor/downloadpaperaspdf_by_editor",array("paper_title"=>$data["paper_title"]))'),
                 ),
             ),
             array( 
                 'header'=>'Everything is fine',
                 'class' => 'CButtonColumn',
                 'template' => '{Publish}',
                 'buttons' => array(
                     'Publish' => array('url' => '$this->grid->controller->createUrl("editor/publish_a_paper",array("paper_id"=>$data["paper_id"]))'),
                 ),
             ),


         ),)
         );         
        ?>
      </div> 
 
</div>




