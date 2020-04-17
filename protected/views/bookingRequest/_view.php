<?php
/* @var $this BookingRequestController */
/* @var $data BookingRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('booking_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->booking_id), array('view', 'id'=>$data->booking_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destination_country')); ?>:</b>
	<?php echo CHtml::encode($data->destination_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_country')); ?>:</b>
	<?php echo CHtml::encode($data->from_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booking_date')); ?>:</b>
	<?php echo CHtml::encode($data->booking_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_date')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('container_count')); ?>:</b>
	<?php echo CHtml::encode($data->container_count); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('net_amount')); ?>:</b>
	<?php echo CHtml::encode($data->net_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance_amount')); ?>:</b>
	<?php echo CHtml::encode($data->balance_amount); ?>
	<br />

	*/ ?>

</div>