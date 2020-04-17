<?php
   $model->vendor_id=$vendor->vendor_id;
   $bp->booking_id=$model->booking_id;
   $bp->vendor_id=$vendor->vendor_id;
   ?>
<?php $form=$this->beginWidget('CActiveForm', array(
   'id'=>'booking-request-form',
     'enableAjaxValidation'=>false,
     'action'=>Yii::app()->createUrl('bookingRequest/completebooking', array('vid' => $vendor->vendor_id)),
   )); ?>
<h3><b>Complete Booking</b></h3>
<div class="row">
   <div class="col-4">
      <div class ="form-group">
         <?php echo $form->labelEx($model,'from_country',array('class'=>'control-label')); ?>
         <?php echo $form->textField($model,'from_country',array('size'=>40, 'class'=>'form-control')); ?>
         <?php echo $form->error($model,'from_country'); ?>
      </div>
      <div class="from-group"   style="margin-top: 31px;">
        <?php echo $form->labelEx($model,'B L Date',array('class'=>'control-label')); ?>
         <?php  
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
             'name'=>'BookingRequest[shipping_date]',
             'value'=>$model->shipping_date,
             'options'=>array(
               'showAnim'=>'fold',
               'dateFormat'=>'yy-mm-dd',
               'changeMonth'=>true,
               'changeYear'=>true,
             ),
             'htmlOptions'=>array(
               'style'=>'width:190px',
               'class'=>'form-control'
             ),
            ));
            ?>
         <?php echo $form->error($model,'shipping_date'); ?>
      </div>
      <br>
      <div class="from-group" style="margin-top: 4px;width: 58%;">
             <?php echo $form->labelEx($bp,'Amount Pay',array('class'=>'control-label')); ?>
         <?php echo $form->textField($bp,'amount',array('size'=>40, 'class'=>'form-control')); ?>
         <?php echo $form->error($bp,'amount'); ?> 
      </div>


      <div class="from-group bank_depo" style="dibplay: none;margin-top: 25px;">
      <?php echo $form->labelEx($bp,'bank_reference_no'); ?>
      <?php echo $form->textField($bp,'bank_reference_no',array('rows'=>3,'class'=>'form-control')); ?>
      <?php echo $form->error($bp,'bank_reference_no'); ?>
   </div>

     <div class="from-group" style="margin-top: 19px;">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'SAVE' : 'Save',array('class'=>'btn btn-primary')); ?>
     </div>

   </div>
   <div class="col-md-4">
      <div class="form-group">
         <?php echo $form->labelEx($model,'destination_country',array('class'=>'control-label')); ?>
         <?php echo $form->textField($model,'destination_country',array('size'=>40, 'class'=>'form-control')); ?>
         <?php echo $form->error($model,'destination_country'); ?>
      </div>

      <div class="form-group"  style="margin-top: 30px;"> 
          <?php echo $form->labelEx($model,'net_amount',array('class'=>'control-label')); ?>
         <?php echo $form->textField($model,'net_amount',array('size'=>40, 'class'=>'form-control')); ?>
         <?php echo $form->error($model,'net_amount'); ?>
      </div>

    <div class="from-group bank_chq" style="dibplay: none;margin-top: 29px;">
        <?php echo $form->labelEx($bp,'cheque_dd_number'); ?>
        <?php echo $form->textField($bp,'cheque_dd_number',array('rows'=>3,'class'=>'form-control')); ?>
        <?php echo $form->error($bp,'cheque_dd_number'); ?>
     </div>
     
   <div class="from-group bank_depo" style="dibplay: none;margin-top: 28px;">
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

   </div>
   <div class="col-md-4">
      <div class="from-group">
         <?php echo $form->labelEx($model,'Order Date',array('class'=>'control-label')); ?>
         <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
             'name'=>'BookingRequest[booking_date]',
            'value'=>$model->booking_date ?$model->booking_date :CTimestamp::formatDate('Y-m-d'),
             'options'=>array(
               'showAnim'=>'fold',
               'dateFormat'=>'yy-mm-dd',
               'changeMonth'=>true,
               'changeYear'=>true,
             ),
             'htmlOptions'=>array(
               'style'=>'width:190px',
               'class'=>'form-control'
             ),
            ));
            ?>
         <?php echo $form->error($model,'booking_date'); ?>
      </div> 
      <br>
      <div class="from-group">
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
             'name'  => 'Payment[payment_mode]',
             'data'   => $opts,
             'placeholder'=>'Select Payment mode',
              'htmlOptions'=>array(
              'style'=>'width:290px'
          ),
         ));
         ?>

      <?php echo $form->error($bp,'payment_mode'); ?>    
      </div>
    <div class="from-group bank" style="dibplay: none;margin-top: 33px;">
        <?php echo $form->labelEx($bp,'bank_name'); ?>
        <?php echo $form->textField($bp,'bank_name',array('rows'=>3,'class'=>'form-control')); ?>
        <?php echo $form->error($bp,'bank_name'); ?>
       </div>
      </div>
      <br>    
  
<?php $this->endWidget(); ?>
   </div>
<br>

<!-- form -->
   
<script type="text/javascript">
   $('document').ready( function(){
   
    $( "#payment_mode" ).bind( "change", function() {
     is_cash = $(this).val();
     $('.bank,.bank_depo,.bank_chq').hide();
     if( is_cash == 'cheque' ) {
      $('.bank,.bank_chq').show();
     }
     if( is_cash == 'direct deposit' ) {
      $('.bank,.bank_depo').show();
     }
     if( is_cash == 'cash'){
      $('.amount,.remark').show();
     }
    } );
   
    $( "#payment_mode" ).trigger( "change" );
   });

    </script>