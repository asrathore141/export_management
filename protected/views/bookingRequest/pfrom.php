
<?php 
  $vendordata = BookingRequest::model()->findAll("vendor_id=".$vend_id);
  $due_list = array();
  foreach($vendordata as $book)
  {
  if($book->total_dues() > 0){
      array_push($due_list,$book['booking_id']);
    }
  }


?>

<?php if(sizeof($due_list) > 0 ): ?>

<h3 style="border-bottom: 1px solid #3071a9;">Payment If Due</h3>

    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'payment-add-form',
      'enableAjaxValidation'=>false,
      'action'=>Yii::app()->createUrl('bookingRequest/AddPayment',array('id'=>$vend_id)),
    )); ?>

 <div class="col-6">

    <?php echo $form->labelEx($bp,'Booking Refr/No'); ?>
       <?php $bookingadd = BookingRequest::model()->findAll($vend_id); 

           $due_list_booking =array();
      foreach($bookingadd as $b)
      {
      
          if($b->total_dues() > 0){
          array_push($due_list_booking,$b['booking_id']);
        }

       }
    ?>
       <?php
          $this->widget('ext.yii-selectize.YiiSelectize', array(
                'model'   => $bp,
                'value'   => $bp->booking_id,
                'name'    => 'BookingRequest[booking_id]',
                'data'    => CHtml::listData($vendordata, 'booking_id', 'fullName'),
                'placeholder'=>'Search Refr/No',
                'fullWidth' => false,
                  'multiple'  => true,
                  ));
            ?>
  </div>
       
  
	   <div class="col-6">
         <?php echo $form->labelEx($bp,'amount'); ?>
         <?php echo $form->textField($bp,'amount',array('size'=>30, 'class'=>'form-control')); ?>
         <?php echo $form->error($bp,'amount'); ?>
      </div>
<br>
  <div class="col-6">
      <?php echo $form->labelEx($bp,'payment_mode'); ?>
        <?php
         $opts = array(
          'cash' => 'Cash',
          'cheque' => 'Cheque',
          'direct deposit' => 'Direct deposit',
         );
         $this->widget('ext.yii-selectize.YiiSelectize', array(
             'model'  => $bp,
             'id'  => 'payment_mode',
             'value'  => $bp->payment_mode,
          'name'  => 'BookingPayment[payment_mode]',
             'data'   => $opts,
             'cssTheme'  => 'default',
             'fullWidth' => false,
             'placeholder'=> 'Payment Mode',
              'htmlOptions'=>array(
               'style'=>'width:190px',
              ),
         ));
         ?>

      <?php echo $form->error($bp,'payment_mode'); ?>
  </div>

  <div class="col-6" style="dibplay: none;">
          <?php echo $form->labelEx($bp,'transaction_date'); ?>
          <?php
             $this->widget('zii.widgets.jui.CJuiDatePicker',array(
              'name'=>'BookingPayment[transaction_date]',
              'id'=>'transaction_date',
              'value'=>$bp->transaction_date ? $bp->transaction_date : null,
              'options'=>array(
               'showAnim'=>'fold',
               'dateFormat'=>'yy-mm-dd',
               'changeMonth'=>true,
               'changeYear'=>true,
              ),
              'htmlOptions'=>array(
               'style'=>'width:190px',
               'class'=>'form-control',
              ),
             ));
             ?>
          <?php echo $form->error($bp,'transaction_date'); ?>
   </div>

<div class="col-6 bank" style="display: none;">
      <?php echo $form->labelEx($bp,'bank_name'); ?>
      <?php echo $form->textField($bp,'bank_name',array('size'=>40, 'class'=>'form-control')); ?>
      <?php echo $form->error($bp,'bank_name'); ?>
   </div>
 
   <div class="col-6 bank_depo" style="display: none;">
      <?php echo $form->labelEx($bp,'bank_reference_no'); ?>
      <?php echo $form->textField($bp,'bank_reference_no',array('size'=>40, 'class'=>'form-control')); ?>
      <?php echo $form->error($bp,'bank_reference_no'); ?>
   </div>
  
   <div class="col-6 bank_chq" style="display: none;">
      <?php echo $form->labelEx($bp,'cheque_dd_number'); ?>
      <?php echo $form->textField($bp,'cheque_dd_number',array('size'=>40, 'class'=>'form-control')); ?>
      <?php echo $form->error($bp,'cheque_dd_number'); ?>
   </div>

   <br>
  <div class="col" style="padding-left: 14px;">
    <?php echo CHtml::submitButton($bp->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
  </div>

<?php $this->endWidget(); ?>

<?php endif; ?>

<!-- form -->
<script type="text/javascript">
   $('document').ready( function(){
   
    $( "#payment_mode" ).bind( "change", function() {
     is_cash = $(this).val();
     $('.bank,.bank_depo,.bank_chq').hide();
     if( is_cash == 'cheque' ) {
      $('.bank,.bank_chq,.bank_bran').show();
     }
     if( is_cash == 'direct deposit' ) {
      $('.bank,.bank_depo,.bank_bran').show();
     }
     if( is_cash == 'cash'){
      $('.amount,.remark').show();
     }
    } );
   
    $( "#payment_mode" ).trigger( "change" );
   });
</script>
