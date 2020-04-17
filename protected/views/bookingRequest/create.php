<?php

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h1 style="margin-top: -30px;"> <img src="<?php echo $baseUrl ;?>/img/head.png" height="150" alt="Current Credit"> New <span style="color:#FF0000;">Booking</span> Request</h1>

<h4 style="margin-top: -13px;">Select <span style="color:#FF0000;">Vendor</span> or Select <span style="color:#FF0000">Mobile</span> Then Click Take Request Button.</h4>
<div class="row">
<div class="col-3">
<?php
	$vendor = Vendor::model()->findAll();
	$this->widget('ext.yii-selectize.YiiSelectize', array(
	    'model' 	=> $model,
	    'value'		=> $model->vendor_id,
		'name'		=> 'BookingRequest[vendor_id]',
	    'data' 		=> CHtml::listData($vendor, 'vendor_id','name'),
	    'cssTheme' 	=> 'default',
	    'placeholder' => 'Search vendor name!',
		'callbacks' => array(
			'onChange' => 'selectClient'
		),
	));
?>

</div>
<div class="col-3">
<?php
	$vendor = Vendor::model()->findAll();
	$this->widget('ext.yii-selectize.YiiSelectize', array(
	    'model' 	=> $model,
	    'value'		=> $model->vendor_id,
		'name'		=> 'BookingRequest[mobile]',
	    'data' 		=> CHtml::listData($vendor, 'vendor_id','mobile'),
	    'cssTheme' 	=> 'default',   
	    'placeholder' => 'Search vendor mobile!',
		'callbacks' => array(
			'onChange' => 'selectClient'
		),

	));
?>
</div>

</div>
<div class="clear clearfix"></div>

<div id="client_info"></div>



<script type="text/javascript">
function selectClient(value) {
	$( "#client_info" ).load( "<?php echo Yii::app()->createUrl('/vendor/PartialView',array('new_request'=> 1, 'id'=>'')); ?>" + value );
}
</script>
