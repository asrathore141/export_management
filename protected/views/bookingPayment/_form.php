<?php
/* @var $this BookingPaymentController */
/* @var $bp BookingPayment */
/* @var $form CActiveForm */
?>


<?php 
  $supplierData = BookingRequest::model()->findAll("vendor_id=".$vend_id);
  $due_list = array();
  foreach($vendordata as $b)
  {
    if($b->total_due() > 0){
      array_push($due_list,$b['booking_id']);
    }
  }
?>

<?php if(sizeof($due_list) > 0 ): ?>

<h1 style="border-bottom: 2px solid #3071a9;">Payment If Due</h1>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-add-form',
	'enableAjaxValidation'=>false,
  'action'=>Yii::app()->createUrl('bookingRequest/AddPayment',array('id'=>$vend_id)),
)); ?>



<div class="row">
    <?php echo $form->labelEx($bp,'Refr/No'); ?>
       <?php $bookingadd = BookingRequest::model()->findAll($vend_id); ?>
        <?php 
           $due_list_booking =array();
      foreach($bookingadd as $b)
      {
      
          if($b->total_due() > 0){
          array_push($due_list_booking,$b);
        }
       
       }
          $this->widget('ext.yii-selectize.YiiSelectize', array(
                'model'   => $bp,
                'value'   => $bp->booking_id,
                'name'    => 'BookingRequest[booking_id]',
                'data'    => CHtml::listData($due_list_booking, 'booking_id', 'booking_id'),
                'cssTheme'  => 'default',
                'placeholder'=>'Search Refr/No',
                'fullWidth' => false,
                  'multiple'  => true,
                  ));
            ?>
  </div>
       
<div  id ="pay">
   <h4 style="border-bottom: 1px solid #000;">Add Due Payment</h4>
  
	<div class="row">
		<?php echo $form->labelEx($bp,'amount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($bp,'amount',array('size'=>40, 'class'=>'form-control')); ?>
		<?php echo $form->error($bp,'amount'); ?>
	</div>

	<div class="row">
	  <?php echo $form->labelEx($bp,'Paymnet Type',array('class'=>'control-label')); ?>
         <?php echo $form->textArea($bp,'details',array('rows'=>1,'class'=>'form-control')); ?>
         <?php echo $form->error($bp,'details'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($bp,'details',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($bp,'details',array('size'=>40, 'class'=>'form-control')); ?>
		<?php echo $form->error($bp,'details'); ?>
	</div>
<br>
	<div class="col">
		<?php echo CHtml::submitButton($bp->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
