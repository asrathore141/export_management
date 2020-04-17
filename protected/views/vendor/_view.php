
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'company_name',
		'phone',
		'mobile',
		'email',
		'address',	
		'gst_no',	
	),
)); ?>
<br/>
<?php
if ( isset($new_request ) ){
	echo CHtml::link(
		'Continue',
		array('bookingRequest/take','vid' => $model->vendor_id),
		array('class'=>'btn btn-primary')
	); 
}
?>
