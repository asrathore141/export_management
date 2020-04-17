

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			array(
			'value' => function($data,$row){ return ($row + 1); },
			'label'=>'#',
			'htmlOptions'=>array(
				'width'=>'2%',
			),
		),
		'name',
		'type',
		'size',
		'thickness',
		'color',
		'unit',
	),
)); ?>
<br/>
