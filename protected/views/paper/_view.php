<?php
/* @var $this PaperController */
/* @var $data Model_paper */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->paper_id), array('view', 'id'=>$data->paper_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('citation_id')); ?>:</b>
	<?php echo CHtml::encode($data->citation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_title')); ?>:</b>
	<?php echo CHtml::encode($data->paper_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_field')); ?>:</b>
	<?php echo CHtml::encode($data->paper_field); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_subject')); ?>:</b>
	<?php echo CHtml::encode($data->paper_subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_number')); ?>:</b>
	<?php echo CHtml::encode($data->issue_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('volume_number')); ?>:</b>
	<?php echo CHtml::encode($data->volume_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_state')); ?>:</b>
	<?php echo CHtml::encode($data->paper_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acceptance_date')); ?>:</b>
	<?php echo CHtml::encode($data->acceptance_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_price')); ?>:</b>
	<?php echo CHtml::encode($data->paper_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_abstract')); ?>:</b>
	<?php echo CHtml::encode($data->paper_abstract); ?>
	<br />

	*/ ?>

</div>