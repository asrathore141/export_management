
<h5 style="margin-left: 70px;"> Vendor Detail</h5>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'company_name',
		array(
			'label'=>'Vendor Name',
		     'name'=>	'name',
		 ),
		array(
			'label'=>'Mobile No',
		     'name'=>	'mobile',
		 ),
		'gst_no',
			),)); ?>