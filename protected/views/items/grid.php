<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$items->search(),
	'template'=>'{items}{summary}{pager}',
	'itemsCssClass' => 'table table-bordered',
	'columns'=>array(
	     array(
			'value' => function($data,$row){ return ($row + 1); },
			'header'=>'#',
			'htmlOptions'=>array(
				'width'=>'2%',
			),
		),
		'container.container_no',       
		'item.name',
		'item.type',
		'item.size',
		'item.thickness',
		'item.color',
		'item.unit',
		'item.entry_date',

	),
)); ?>
