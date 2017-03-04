<?php
/* @var $this PaperController */
/* @var $data Model_paper */

    $this->breadcrumbs=array(
	'Editor Panel'=>array('editorspanel'),
    );

    
    
  

?>



<div class="view">

<!--	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->paper_id), array('view', 'id'=>$data->paper_id)); ?>
	<br />-->
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('paper_title')); ?>:</b>
	<?php echo CHtml::encode($data->paper_title); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('paper_subject')); ?>:</b>
	<?php echo CHtml::encode($data->paper_subject); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('paper_field')); ?>:</b>
	<?php echo CHtml::encode($data->paper_field); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('paper_abstract')); ?>:</b>
	<?php echo CHtml::encode($data->paper_abstract); ?>
	<br />
        <br>
        <b class="btn">
        <?php echo CHtml::link('Download as Doc',Yii::app()->createUrl("paper/downloadpaper",array("name"=>$data->paper_title)))  ; ?>
        </b>
        
        <b class="btn">
        <?php echo CHtml::link('Download as Pdf',Yii::app()->createUrl("paper/downloadpaperaspdf",array("name"=>$data->paper_title)))  ; ?>
        </b>
        
        <?php //echo CHtml::button("Download",array("class"=>'btn btn-success',"action"=>""));?>
</div>

