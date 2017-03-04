<?php
/* @var $this PaperController */
/* @var $data Model_paper */
/* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
	'Download Papers'=>array('downloadindex'),
    );
  
    
//    echo $data->author->author_first_name;
//    echo $data->citation->downloaded_full;
    
    $temp=CHtml::encode($data->paper_title);    
    $len=strlen($temp);
    
    $check= substr($temp, $len-1, $len);
    $cut_name;
    if($check==='x')
    {
        $cut_name=substr($temp, 11, -5);
    }
//    else if($check==='c')
//    {
//         $cut_name= substr($temp, 11, -4);
//    }
   // $cut_name= substr($temp, 10, -5);
   
//    $temp=  CHtml::encode($data->paper_abstract);
//    $len=strlen($temp); 
//    $absract=  substr($temp,0,100);
    
    
?>

<div class="row-fluid">

<div class="row-fluid" style="font-size:16px;line-height: 20px;font-family: tahoma;">
        <div class="span12">

        <!--	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->paper_id), array('view', 'id'=>$data->paper_id)); ?>
                <br />-->

                <p align="center" style=""><?php echo CHtml::encode($data->getAttributeLabel('paper_title')); ?>:
                   <strong> <?php echo CHtml::encode($cut_name); ?></strong>
                </p>

                <p><?php echo CHtml::encode($data->getAttributeLabel('paper_subject')); ?>:
                <?php echo CHtml::encode($data->paper_subject); ?>
                </p>

                <p><?php echo CHtml::encode($data->getAttributeLabel('paper_field')); ?>:
                <?php echo CHtml::encode($data->paper_field); ?>
                </p>
                
                <p><?php echo CHtml::encode($data->getAttributeLabel('issue_number')); ?>:
                <?php echo CHtml::encode($data->issue_number); ?>
                </p>
                
                <p><?php echo CHtml::encode($data->getAttributeLabel('volume_number')); ?>:
                <?php echo CHtml::encode($data->volume_number); ?>
                </p>
                
                <p><?php echo CHtml::encode($data->getAttributeLabel('acceptance_date')); ?>:
                <?php echo CHtml::encode($data->acceptance_date); ?>
                </p>
                
                <p><?php echo CHtml::encode($data->getAttributeLabel('paper_abstract')); ?>:
                <?php echo CHtml::encode($data->paper_abstract); ?>
                </p>
                <br>
                
        <!--        <b class="btn">
                <?php echo CHtml::link('Download as Pdf',Yii::app()->createUrl("paper/downloadpaperaspdf",array("name"=>$data->paper_title)))  ; ?>
                </b>-->

                <?php //echo CHtml::button("Download",array("class"=>'btn btn-success',"action"=>""));?>
        </div>
    <div class="row-fluid">
        <div class="span4">Total Downloads:<?php echo CHtml::encode($data->citation->downloaded_full);?></div>
         <div class="span4">Total Views:<?php echo CHtml::encode($data->citation->viewed_full);?></div>
         <div class="span4"></div>
    </div>
    
    <div class="row-fluid btn-group ">
                    <?php echo CHtml::link('<p class="icon-download"></p>Download as Doc/Docx',Yii::app()->createUrl("paper/downloadpaper",array("name"=>$data->paper_title,)),array("class"=>"btn btn-success"))  ; ?>
                    <?php echo CHtml::link('<p class="icon-download"></p>Download as Pdf',Yii::app()->createUrl("paper/downloadpaperaspdf",array("name"=>$data->paper_title)),array("class"=>"btn btn-warning"))  ; ?>
                    <?php echo CHtml::link('<p class="icon-eye-open"></p>View More',Yii::app()->createUrl("paper/view",array("id"=>$data->paper_id,)),array("class"=>"btn btn-info"))  ; ?>
                    <?php //echo CHtml::link('Buy now',Yii::app()->createUrl("paper/view",array("id"=>$data->paper_id,)),array("class"=>"btn btn-warning"))  ; ?>
    </div>
    
</div>
   
<hr>

</div>
