<?php
/* @var $this Registered_visitorsController */
/* @var $data Model_RegisteredVisitors */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->visitor_id), array('view', 'id'=>$data->visitor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitor_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->visitor_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitor_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->visitor_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />


</div>