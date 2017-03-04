<?php
/* @var $this EditorController */
/* @var $data Model_Editor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('editor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->editor_id), array('view', 'id'=>$data->editor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('editor_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->editor_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('editor_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->editor_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />


</div>