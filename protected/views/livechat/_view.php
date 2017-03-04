<?php
/* @var $this LivechatController */
/* @var $data Model_LiveChat */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('chat_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->chat_id), array('view', 'id'=>$data->chat_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chat_date')); ?>:</b>
	<?php echo CHtml::encode($data->chat_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chat_time')); ?>:</b>
	<?php echo CHtml::encode($data->chat_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chat_message')); ?>:</b>
	<?php echo CHtml::encode($data->chat_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chat_pass_code')); ?>:</b>
	<?php echo CHtml::encode($data->chat_pass_code); ?>
	<br />


</div>