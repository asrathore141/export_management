<?php
/* @var $this ItemsController */
/* @var $model Items */


$this->menu=array(
	array('label'=>'Add Item', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>View <span style="color:#1f75d3;">Items</span></h2>
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
            array('label'=>'Add Items', 'linkOptions'=>array('class'=>'btn btn-primary noprint'), 'url'=>array('items/create')),        
        ),
    )); ?>
	<div class="search-form" style="display:none">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
   </div>	
</div>

<!-- search-form -->
<div class="">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-bordered',
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
       'name'=>'Photo', // 
        'type'=>'raw',
         'value' => function($data){
            		return CHtml::image(
            			$data->photo(), '', array('style' => ' width: 80px')
            		);
 				  }
         ),
		 array(
		'name'=>'name',
		'urlExpression'=>'array("items/view","id"=>$data->item_id)',
		 'class'=>'YDataLinkColumn',
		),
		'type',
		'size',
		'thickness',
		'color',
		'unit',
		array(
			'header'=>'Action',
           'class'=>'CButtonColumn',
            'template'=>'{delete}{view}{update}',
            'visible' => Yii::app()->user->isAdmin() ? true : false,
           ),
	),
)); ?>

</div>

<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
});
</script>