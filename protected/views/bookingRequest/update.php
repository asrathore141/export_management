<?php
/* @var $this BookingRequestController */
/* @var $model BookingRequest */

$this->breadcrumbs=array(
	'Booking Requests'=>array('index'),
	$model->booking_id=>array('view','id'=>$model->booking_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BookingRequest', 'url'=>array('index')),
	array('label'=>'Create BookingRequest', 'url'=>array('create')),
	array('label'=>'View BookingRequest', 'url'=>array('view', 'id'=>$model->booking_id)),
	array('label'=>'Manage BookingRequest', 'url'=>array('admin')),
);
?>

<h1>Update BookingRequest <?php echo $model->booking_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>