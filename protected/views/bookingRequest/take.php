<?php

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

?>

<div class="row">

	<div class="col-5">
	<h2><b>Add Booking</b>  <img src="<?php echo $baseUrl ;?>/img/ships.png" height="150" alt="Current Credit"></h2>
	</div>
	<div class="col-7">
	<?php
		$this->renderPartial('//vendor/_view1',array(
			'model'=> $vendor
		));
	?>
</div>
</div>


<div class="col-md-12">
	<?php
	$container = new Container;
	$container->unsetAttributes();
	$container->vendor_id = $vendor->vendor_id;
    $container->booking_id = 000;
	
    $model = new BookingRequest;

	$items = new ContainerItems;
	$items->unsetAttributes();
	$items->vendor_id = $vendor->vendor_id;
	$items->booking_id = 000;

	 $bp = new BookingPayment;

?>

<?php

$tabs = array();
$tab_active = 0;
$tabs['Add Container'] = $this->renderPartial('/bookingRequest/container',array('vendor'=> $vendor,'container' => $container),TRUE);

$container_array = Container::model()->findAll(array('condition'=>'booking_id = "0" AND vendor_id = '.$vendor->vendor_id));
$items_array = ContainerItems::model()->findAll(array('condition'=>'booking_id = "0" AND vendor_id = '.$vendor->vendor_id));

if ( $container_array ) {
  $tabs['Add Items'] = $this->renderPartial('/bookingRequest/items',array('vendor'=> $vendor,'container' => $container,'items'=>$items),TRUE);
  $tab_active = 1;
}
if ( $items_array) {
$tabs['Complete Booking'] =$this->renderPartial('/bookingRequest/_form',array('model' => $model,'bp'=>$bp,'vendor'=> $vendor),TRUE);
	$tab_active = 2;
}
$this->widget('zii.widgets.jui.CJuiTabs', array(
                'tabs' => $tabs,
                'options' => array(
                 ),
));
?>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		setTimeout(function(){
			$( "#yw5" ).tabs( "disable" );
			for( i=0; i<=<?php echo $tab_active; ?>; i++){
				$( "#yw5" ).tabs( "enable", i );
			}

			$('.ui-tabs-panel .btn').click( function(e){
				var number = $(this).closest('.ui-tabs-panel').attr('aria-labelledby').replace('ui-id-','');
				$( "#yw5" ).tabs( "enable", number );
				$( "#ui-id-"+ (parseInt(number) + 1) ).trigger( 'click' );
			});

		}, 500);

	});
</script>
			
