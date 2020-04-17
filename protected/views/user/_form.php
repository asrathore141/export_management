<?php

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

?>

<?php $form=$this->beginWidget('CActiveForm', array(
   'id'=>'vendor-form',
   'enableAjaxValidation'=>false,
   )); ?>
<div  id ="additem">
   <h2 style="border-bottom: 2px solid #0000003d;">Add <span style="color:#1f75d3;">Vendor<img src="<?php echo $baseUrl ;?>/img/vendors.png" height="70" alt="Current Credit"></h2>
   <div class="row">
   <div class="col-md-4">
      <div class="form-group">
		<?php echo $form->labelEx($model,'Username*'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
   </div>
  </div>
  <div class="row">
   <div class="col-md-4">
		<?php echo $form->labelEx($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'full_name'); ?>
	</div>
   <div class="col-md-4">
      <div class="forom-group">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Mobile 1'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Mobile 2'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'mobile'); ?>
   </div>
      <br>
   </div>
   <div class="col-md-4">
      <div class="forom-group">
		<?php echo $form->labelEx($model,'email_id'); ?>
		<?php echo $form->textField($model,'email_id',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'email_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gst_no'); ?>
		<?php echo $form->textField($model,'gst_no',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'gst_no'); ?>
	   </div>
      <br>
   </div>
   <div class="col-md-4">
      <div class="forom-group">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
		<?php echo $form->error($model,'role'); ?>
      </div>
   </div>
   <div class="col-2">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
   </div>
   <?php $this->endWidget(); ?>
</div>
</div>