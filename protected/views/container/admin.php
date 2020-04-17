
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'container-grid',
	'itemsCssClass' => 'table table-bordered',
	'dataProvider'=>$container->search(),
	'columns'=>array(
			array(
			'value' => function($data,$row){ return ($row + 1); },
			'header'=>'#',
			'htmlOptions'=>array(
				'width'=>'2%',
			),
		),
		'vendor.name',
		'container_no',
		'sea_name',
		'container_company',
	),
)); ?>
