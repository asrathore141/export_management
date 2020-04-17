>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'container-items-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
        'contitem.name',
		'contitem.type',
		'contitem.size',
		'contitem.thickness',
		'contitem.color',
		'contitem.unit',
		'contitem.entry_date',
	
	),
)); ?>
