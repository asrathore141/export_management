<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'Update Items', 'url'=>array('update', 'id'=>$model->item_id)),
	array('label'=>'Delete Items', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->item_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>View Items #<?php echo $model->item_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	 array(
       'name'=>'Photo', // 
        'type'=>'raw',
         'value' => function($data){
            		return CHtml::image(
            			$data->photo(), '', array('style' => ' width: 80px')
            		);
 				  }
         ),
		'name',
		'type',
		'size',
		'thickness',
		'color',
		'unit',
		'entry_date',
	),
)); ?>
