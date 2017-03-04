<?php
/* @var $this NewsController */
/* @var $data Model_News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->news_id), array('view', 'id'=>$data->news_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_date')); ?>:</b>
	<?php echo CHtml::encode($data->news_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_time')); ?>:</b>
	<?php echo CHtml::encode($data->news_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_heading')); ?>:</b>
	<?php echo CHtml::encode($data->news_heading); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_body')); ?>:</b>
	<?php echo CHtml::encode($data->news_body); ?>
	<br />


</div>