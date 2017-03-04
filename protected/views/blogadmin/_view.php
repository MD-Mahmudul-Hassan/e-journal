<?php
/* @var $this BlogadminController */
/* @var $data Model_blog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comment_id), array('view', 'id'=>$data->comment_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_date')); ?>:</b>
	<?php echo CHtml::encode($data->comment_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_time')); ?>:</b>
	<?php echo CHtml::encode($data->comment_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_message')); ?>:</b>
	<?php echo CHtml::encode($data->comment_message); ?>
	<br />


</div>