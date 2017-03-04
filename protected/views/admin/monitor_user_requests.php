<?php
/* @var $this AdminController */
/* @var $data Model_request */

$model1=new Model_request;

$model1->request_id=$data->request_id;


$this->breadcrumbs=array(
	'Admin Panel'=>array('adminpanel'),
        'User Request Panel'=>array('user_request_monitor','_request_type'=>'paper'),
);


?>

<div class="row-fluid" style="font-size:16px;line-height: 30px;">
    <div class="view span7">

            <h4 align="center"><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
            <?php echo CHtml::link(CHtml::encode($data->request_id), array('view', 'id'=>$data->request_id)); ?>
            </h4><br>

            <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:
            <?php echo CHtml::encode($data->email); ?>
            </b><br>

            <b><?php echo CHtml::encode($data->getAttributeLabel('request_type')); ?>:</b>
            <?php echo CHtml::encode($data->request_type); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('request_subject')); ?>:</b>
            <?php echo CHtml::encode($data->request_subject); ?>
            <br />
            <b><?php echo CHtml::encode($data->getAttributeLabel('request_message')); ?>:</b>
            <?php echo CHtml::encode($data->request_message); ?>
            <br />
            <b><?php echo CHtml::encode($data->getAttributeLabel('request_approval')); ?>:</b>
            <?php echo CHtml::encode($data->request_approval); ?>
            <br />
            <div class="row-fluid">
               <div class="span12">     
                <?php
                        if($data->request_type==='advertisement' && $data->request_subject!='Not needed')
                        {
                            $path=Yii::app()->basePath.'/advertisement_images/tYc@&24fsY_!a126rvlf7edkcPZn#!pkm503a!wJ_dsa/%das#daffD_ypmw!25c6v1r7w9aJGF_&@52!%^@%^&/'.$data->request_subject;    
                            $image_url=  Yii::app()->assetManager->publish($path);
                            echo "<b>The Image:</b><br> ";
                            echo CHtml::image($image_url);
                        }


                ?>
               </div>
            </div>
            
            
            <br>
            <div class="row-fluid">
                 <?php echo CHtml::link('Accept Request',  CHtml::normalizeUrl(array('admin/accept_user_request','request_id'=>$data->request_id)),array("class"=>"btn btn-success span3",'style'=>'float:left;'))  ; ?>
                 <?php echo CHtml::link('Reject Request',  CHtml::normalizeUrl(array('admin/rejecting_user_request','request_id'=>$data->request_id)),array("class"=>"btn btn-danger span3",'style'=>'float:right;'))  ; ?>           
            </div>

           

        </div>
    
</div>