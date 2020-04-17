<h4 style ="color: #464a4e;">Booked Conatiner</h4>
<?php $this->widget('zii.widgets.CDetailView', 
array( 
	'data'=>$model, 
	'attributes'=>array( 
		'container_no',
		'sea_name', 
		'container_company', 
  ),
)); 
?>