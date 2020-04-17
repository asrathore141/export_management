<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'address',
		'phone',
		'mobile',
		'email',
		'company_name',
		'gst_no',
		'entry_date',
	),
)); ?>
<br/>
<?php
if ( isset($new_request ) ){
	echo CHtml::link(
		'Continue',
		array('bookingRequest/take','cid' => $model->vendor_id),
		array('class'=>'btn btn-primary')
	); 
}
?>
