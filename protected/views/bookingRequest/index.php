<?php
/* @var $this BookingRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Booking Requests',
);

$this->menu=array(
	array('label'=>'Create BookingRequest', 'url'=>array('create')),
	array('label'=>'Manage BookingRequest', 'url'=>array('admin')),
);
?>

<h1>Booking Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
