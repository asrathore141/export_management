<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>View <span style="color:#1f75d3;">Vendors</span> </h2>
	<div class="">
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-warning')); ?>
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
            array('label'=>'Add Vendor', 'linkOptions'=>array('class'=>'btn btn-primary noprint'), 'url'=>array('vendor/create')),        
        ),
    )); ?>
	<div class="search-form" style="display:none">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
   </div>	
</div>

<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vendor-grid',
	'dataProvider'=>$model->search(),
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
			'header' => 'Vendor',
			'name'=>'name',
			'urlExpression'=>'array("bookingRequest/vendorview","vendorid"=>$data->vendor_id)',
			'class'=>'YDataLinkColumn',
		),
		'address',
		'phone',
		'mobile',
		'email',
		'password',
		'company_name',
		'gst_no',
		'entry_date',
		array(
			'header'=>'Action',
           'class'=>'CButtonColumn',
            'template'=>'{delete}{view}{update}',
           ),
	),
	)
); ?>

<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
});
</script>