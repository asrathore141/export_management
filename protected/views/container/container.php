<?php
/* @var $this ContainerController */
/* @var $model Container */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'container-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'container_no'); ?>
		<?php echo $form->textField($model,'container_no'); ?>
		<?php echo $form->error($model,'container_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sea_name'); ?>
		<?php echo $form->textField($model,'sea_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sea_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'container_company'); ?>
		<?php echo $form->textField($model,'container_company',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'container_company'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->