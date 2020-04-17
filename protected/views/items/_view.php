

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'type',
		'size',
		'thickness',
		'color',
		'unit',
	),
)); ?>
<br/>
