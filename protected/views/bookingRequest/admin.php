<?php 
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 style="color:#000;">Manage <span style="color:#1f75d3;">Booking</span> Requests</h2>

	<div class="">
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-warning noprint')); ?>
			<?php
      echo CHtml::link(
        'Print Record',
        '#',
        array(
          'class'=>'btn btn-success noprint',
          'id' => 'printme'
        )
      );
      ?>
   <?php $this->widget('zii.widgets.CMenu',array(
        'htmlOptions'=>array('style'=>' margin-top: -45px;  margin-left: 217px'),   

        'itemCssClass'=>'btn',
        'encodeLabel'=>false,
        'items'=>array(
            array('label'=>'Add Booking', 'linkOptions'=>array('class'=>'btn btn-primary noprint'), 'url'=>array('bookingRequest/create')),        
        ),
    )); ?>
	<div class="search-form" style="display:none">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
   </div>	
</div>

<?php
	$latest_booking = array();
	$found = array();
	foreach ($model->search(false,'shipping_date DESC')->getData() as $book) {
		$book->booking_id = $book->booking_id;
		if ( in_array($book->booking_id, $found) ) {
			continue;
		}
		array_push($found, $book->booking_id);
		array_push($latest_booking, $book);
	}

	//convert to CArrayDataProvider
	$dataProviderCompined = new CArrayDataProvider($latest_booking, array(
       
        	 
	));

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'booking-request-grid',
	'dataProvider'=>$model->search(20),
	'template'=>'{items}{summary}{pager}',
	'columns'=>array(
		array(
			'value' => function($data,$row){ return ($row + 1); },
			'header'=>'#',
			'htmlOptions'=>array(
				'width'=>'2%',
			),
		),
		 array(
	        'name'=>'booking_id',
    	   	'header'=>'Booking Id',
        	'value' => function($data){
        		return 'SW/BOOK/'.$data->booking_id;
      		},
		    'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
			'class'=>'YDataLinkColumn',
        ),
		array(
			'header' => 'Vendor',
			'name'=>'vendor.name',
		    'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
			'class'=>'YDataLinkColumn',
		),
		'destination_country',
		'from_country',
		array(
		'name'=>'booking_date',
		'value'=>'date_format(date_create($data->booking_date), "j M, Y")'
        	),
		array(
		'name'=>'shipping_date',
		'value'=>'date_format(date_create($data->shipping_date), "j M, Y ")'
        	),
		'status',
		array(
			 'header'=>'Payment Dues',
			 'type' =>'raw',
			 'value'=> function($data){

            $today = $data->shipping_date;
            $color = 'red'; // Or can put $today = date ("Y-m-d");

			$fiveDays = date ("j M, Y", strtotime ($today ."+90 days"));
			return "<span style='color:$color'><b>Payment Due On $fiveDays </b>&nbsp;";
			 
			 },
		),
		
		array(
			'header' => 'Total Bill',
			'type' => 'raw',
			'value' => function($data){
				return '<span class="badge badge-success">'.'$'. number_format($data->total_bill(),2). '</span>';
			}
		),
		array(
			'header' => 'Total Paid',
			'type' => 'raw',
			'value' => function($data){
				return '<span class="badge badge-warning">'.'$'. number_format($data->total_paid(),2). '</span>';
			}
		),
		array(
			'type' => 'raw',
			'header' => 'Total Due',
			'value' => function($data){
				return '<span class="badge badge-danger">'.'$'. number_format($data->total_due(),2). '</span>';
			}
		),

	),
)); ?>

<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
});
</script>
   