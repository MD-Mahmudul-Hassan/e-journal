<?php
/* @var $this AdminController */
/* @var $dataProvider CSqlDataProvider */
/* @var $form CActiveForm */
/* @var $model1 Model_paper_editors */



 $this->widget('ext.yiibooster.widgets.TbAlert', array('fade' => true,'closeText' => '&times;','events' => array(),'htmlOptions' => array(),'userComponentId' => 'user',
                            'alerts' => array(
                            'success' => array('closeText' => 'close'),
                            'warning' => array('closeText' => 'close;'),
                            'error' => array('closeText' => 'CLOSE'),
                            ),
                            ));


$model1=new Model_paper_editors;
$condition= new CDbCriteria;
$condition->condition="paper_state='Waiting for admin response'";
$models = Model_paper::model()->findAll($condition); 
$list = CHtml::listData($models,'paper_id', 'paper_title');
//----------------------------------------------------
//$condition->condition="paper_state='Waiting for admin response'";
$models = Model_Editor::model()->findAll(); 
$list2 = CHtml::listData($models,'editor_id','editor_last_name');
//---------------------------------------------------

$this->breadcrumbs=array(
	'Admin Panel'=>array('adminpanel'),
);

//$this->menu=array(
//	array('label'=>'Manage Papers', 'url'=>array('paper/index')),
//        array('label'=>'Manage Admins','url'=>array('admin/index')),
//        array('label'=>'Manage Authors','url'=>array('/author/index')),
//        array('label'=>'Manage Editors','url'=>array('/editor/index')),
//        array('label'=>'Manage Visitors', 'url'=>array('registered_visitors/index')),
//        array('label'=>'Manage Email', 'url'=>array('email/index')),
//        array('label'=>'Manage Blog', 'url'=>array('blogadmin/index')),
//        array('label'=>'Download Paper', 'url'=>array('/paper/downloadindex')),       
//);

?>
<div class="row-fluid">
    <div class="row-fluid">
       <div class="row-fluid"> 
        <h3><p class="icon-check"></p>Admin Panel</h3>
        <hr>
          </div>
        
      <div class="row-fluid">           
           <div class="span9"> 
            <?php 
                $collapse = $this->beginWidget('ext.yiibooster.widgets.TbCollapse'); ?>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title" >
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration: none;padding: 5px;" class="btn btn-block">
                                        Assign Editor's to papers
                                    </a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body" style="margin-left: 20px;">
                                        <div class="form">
                                            <?php $form=$this->beginWidget('CActiveForm', array(
                                                'id'=>'admin-form',
                                                'enableAjaxValidation'=>false,
                                                'enableClientValidation'=>true,
                                                'action'=>array('admin/adminpanel','email'=>  Yii::app()->user->name),
                                                )); ?>
                                            <p class="note">Fields with <span class="required">*</span> are required.</p>
                                            <?php echo $form->errorSummary($model1); ?>
                                            <div class="row">
                                                    <?php echo $form->labelEx($model1,'paper_id'); ?>
                                                    <?php //echo $form->textField($model1,'paper_id',array('style'=>'width:250px;border-radius:10px 10px 10px 10px;padding:5px;font-size:14px;')); ?>
                                                    <?php echo $form->DropDownList($model1, 'paper_id', $list,array('empty'=>'Select Paper Name','class'=>'span4'));  ?>

                                                    <?php echo $form->error($model1,'paper_id'); ?>
                                            </div>

                                            <div class="row">
                                                    <?php echo $form->labelEx($model1,'editor_id'); ?>
                                                    <?php echo $form->DropDownList($model1, 'editor_id', $list2,array('empty'=>"Select Editor's Name"));  ?>
                                                    <?php echo $form->error($model1,'editor_id'); ?>
                                            </div>                                    
                                            <br>
                                            <div class="row">
                                                <?php echo CHtml::submitButton('Assign',array('class'=>'btn btn-info','style'=>"width:220px;font-size:15px;")); ?>
                                            </div>
                                        <?php $this->endWidget(); ?>                                
                                        <hr>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                         </div>
                <?php $this->endWidget(); ?>
               <div class="row-fluid btn-group">    
                    <?php echo CHtml::link('Monitor Reviewers',  Yii::app()->createUrl('admin/reviewer_monitor'),array("class"=>"btn btn-success"));?>
                    <?php echo CHtml::link('Monitor User Requests',  CHtml::normalizeUrl(array('admin/user_request_monitor','_request_type'=>'paper')),array("class"=>"btn btn-success"));?>
                    <?php echo CHtml::link('Live Chat',Yii::app()->createUrl('livechat/code_checking_gate',array('image_url'=>$profile_image)),array("class"=>'btn btn-success','target'=>'_blank'));?>
                    <?php echo CHtml::link('Download Paper',Yii::app()->createUrl('paper/downloadindex'),array("class"=>"btn btn-success"));?>
                    <?php echo CHtml::link('Options',Yii::app()->createUrl('options/option_main'),array("class"=>"btn btn-success"));?>
                    <?php echo CHtml::link('Publish News',Yii::app()->createUrl('news/index'),array("class"=>"btn btn-success"));?>
               </div><hr>
               <div class="row-fluid"><h4>System Data Management</h4></div><br>
               <div class="row-fluid btn-group">
                   <?php echo CHtml::link('User Details',Yii::app()->createUrl('email/admin'),array("class"=>'btn btn-danger'));?>
                   <?php 
                   $url=  CHtml::normalizeUrl(array('admin/admin'));
                   echo CHtml::link('Admin',Yii::app()->createUrl('admin/admin'),array("class"=>'btn btn-danger','onclick' => 'javascript:window.open(<?php echo "$url" ;?>,"x","width=400,height=500"); return false;','target'=>'_blank'));?>
                   <?php echo CHtml::link('Author',Yii::app()->createUrl('author/admin'),array("class"=>'btn btn-danger'));?>
                   <?php echo CHtml::link('Editor',Yii::app()->createUrl('editor/admin'),array("class"=>'btn btn-danger'));?>
                   <?php echo CHtml::link('Paper',Yii::app()->createUrl('paper/admin'),array("class"=>'btn btn-danger'));?>
                   <?php echo CHtml::link('Blog',Yii::app()->createUrl('blogadmin/admin'),array("class"=>'btn btn-danger'));?>
                   <?php echo CHtml::link('Requests',Yii::app()->createUrl('request/admin'),array("class"=>'btn btn-danger'));?>
                   <?php echo CHtml::link('Chat',Yii::app()->createUrl('livechat/admin'),array("class"=>'btn btn-danger'));?>
                 
               </div>
             </div>
            <div class="span3">
                <div class="row-fluid"><img  src="<?php echo $profile_image; ?>" width="100%" height="100%" style="max-width: 300px; max-height:250px; "></div>
                <div class="row-fluid">                    
                  <?php 
                $collapse = $this->beginWidget('ext.yiibooster.widgets.TbCollapse'); ?>
                        <div class="panel-group" id="accordion1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title" >
                                     <a data-toggle="collapse" data-parent="#accordion1" href="#collapseprofile"  class="btn btn-info btn-block">
                                Change
                                    </a>
                                    </div>
                                </div>
                                <div id="collapseprofile" class="panel-collapse collapse out">
                                    <div class="panel-body" style="margin-left: 20px;">
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
                                        <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success btn-block')); ?>
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
          
          
          
          </div>
        </div>
        <br><br><br><br>
    <div class="row-fluid">    
        <p align="center" style="font-size:30px;font-family: tahoma;;">Latest Paper Submissions</p>

        <div style="font-size: 110%;">
              
        
        <?php

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'a-grid-id',
            'dataProvider' => $model,
            'filter'=>null,
            'columns' => array(
                array(
                    'header' => 'Author Name',
                    'name' => 'author_last_name',         
                ), 
                array(
                    'header' => 'Paper ID',
                    'name' => 'paper_id',            
                ),
                 array(
                    'header' => 'Paper Subject',
                    'name' => 'paper_subject',        
                ),
                array(
                    'header' => 'Paper Title',
                    'name' => 'paper_title',         
                ),         

                array(
                    'header' => 'Paper Status',
                    'name' => 'paper_state',        
                ),
                array( 
                 'header'=>'Download Paper',
                 'class' => 'CButtonColumn',
                 'template' => '{Download}',
                 'buttons' => array(
                     'Download' => array('url' => '$this->grid->controller->createUrl("admin/primary_paper_download_by_admin",array("id"=>$data["paper_id"]))'),
                                    ),                 
                    ),
                array(
                    'name'  => 'Reject',
                    'value' => "CHtml::link('Reject',array('admin/primary_paper_rejection_by_admin','id'=>\$data['paper_id']))",
                    'type'  => 'raw',
                    )
  

        //         array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
        //            'class' => 'CButtonColumn',
        //            'template' => '{create}',
        //            'buttons' => array(
        //                'create' => array('url' => '$this->grid->controller->createUrl("adminpanel")'),
        //            ),
        //        ),       
            ),)
            );
            
        ?>


            </div>
      </div>
</div>