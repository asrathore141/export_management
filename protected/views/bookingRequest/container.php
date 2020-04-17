<h3><b>Add Container</b></h3>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'container-form',
     'enableAjaxValidation'=>false,
      'action'=>Yii::app()->createUrl('bookingRequest/addcontainer', array('vid' => $vendor->vendor_id)),
      ));
       ?>

	<?php echo $form->errorSummary($container); ?>
  <div class="row">
  	<div class="col-md-4">
  <div class="form-group">
		<?php echo $form->labelEx($container,'container_company',array('class'=>'control-label')); ?>
		<?php echo $form->textField($container,'container_company',array('size'=>40, 'class'=>'form-control')); ?>
		<?php echo $form->error($container,'container_company'); ?>
	</div>
	</div>
		<div class="col-md-4">
  <div class="form-group">
		<?php echo $form->labelEx($container,'container_no',array('class'=>'control-label')); ?>
		<?php echo $form->textField($container,'container_no',array('size'=>40, 'class'=>'form-control')); ?>
		<?php echo $form->error($container,'container_no'); ?>
	</div>
  </div>
	<div class="col-md-4">
     <div class="form-group">
		<?php echo $form->labelEx($container,'sea_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($container,'sea_name',array('size'=>40, 'class'=>'form-control')); ?>
		<?php echo $form->error($container,'sea_name'); ?>
	</div>
	</div>
</div>
	<div class="col-md-4">
		<?php echo CHtml::submitButton($container->isNewRecord ? 'ADD' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
   <br>
<?php $this->endWidget(); ?>

<?php
	$this->renderPartial('//container/admin',array('container'=>$container));
?>

 