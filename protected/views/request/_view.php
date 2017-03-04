<?php
/* @var $this RequestController */
/* @var $data Model_request */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->request_id), array('view', 'id'=>$data->request_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

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


</div>