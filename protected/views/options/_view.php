<?php
/* @var $this OptionsController */
/* @var $data Model_options */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->option_id), array('view', 'id'=>$data->option_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_action_name')); ?>:</b>
	<?php echo CHtml::encode($data->option_action_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_action_state')); ?>:</b>
	<?php echo CHtml::encode($data->option_action_state); ?>
	<br />


</div>