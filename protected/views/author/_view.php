<?php
/* @var $this AuthorController */
/* @var $data Author */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->author_id), array('view', 'id'=>$data->author_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->author_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->author_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); 
            
        ?>
	<br />


</div>