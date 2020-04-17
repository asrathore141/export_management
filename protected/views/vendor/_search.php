<?php
/* @var $this VendorController */
/* @var $model Vendor */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<br>
   <div class="row">
   <div class="col-4">
      <div class="form-group">
          <?php echo $form->labelEx($model,'Enter Name'); ?>
              <?php echo $form->textField($model,'name',array('size'=>40, 'class'=>'form-control')); ?>
      
	</div>

	<div class="form-group">
		   <?php echo $form->labelEx($model,'Phone No',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'phone',array('size'=>40, 'class'=>'form-control')); ?>
	</div>
<div class="form-group">
          <?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
  </div>


</div>
<div class="col-4">
	<div class="form-group">
		   <?php echo $form->labelEx($model,'Mobile No',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>40, 'class'=>'form-control')); ?>
	</div>


	<div class="form-group">
		   <?php echo $form->labelEx($model,'Company Name'); ?>
  	<?php echo $form->textField($model,'company_name',array('size'=>40, 'class'=>'form-control')); ?>
      
	</div>
    </div>

	
<?php $this->endWidget(); ?>
</div>

<!-- search-form -->
