<?php
/* @var $this BookingRequestController */
/* @var $model BookingRequest */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
 <div class="row">
      <div class="col-md-3">
         <div class="form-group">
   <?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
		<?php
	$vendor = Vendor::model()->findAll();
	$this->widget('ext.yii-selectize.YiiSelectize', array(
	    'model' 	=> $model,
	    'value'		=> $model->vendor_id,
		'name'		=> 'BookingRequest[vendor_id]',
	    'data' 		=> CHtml::listData($vendor, 'vendor_id','name'),
	    'cssTheme' 	=> 'default',
	    'placeholder' => 'Search vendor name!',
		'callbacks' => array(
			'onChange' => 'selectClient'
		),
		 'htmlOptions'=>array(
               'class'=>'form-control'
             ),
	   ));
   ?>
     </div>

      <div class="form-group">
        <?php echo $form->labelEx($model,'from_country',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'from_country',array('size'=>30, 'class'=>'form-control')); ?>
     </div>

   <div class="form-group">
     <?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
      </div>
    </div>
      <div class="col-md-3" style ="margin-top: 2px;">
         <div class="form-group">
		<?php echo $form->label($model,'booking_date',array('class'=>'control-label')); ?>

    <?php 
      echo CHtml::textField('BookingRequest[booking_date]',$model->booking_date,array( 'style'=>'width:145px;', 'size'=>7, 'id' =>'date_start', 'class'=>'form-control'));
    ?>
         </div>

          <div class="form-group">
        <?php echo $form->labelEx($model,'destination_country',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'destination_country',array('size'=>30, 'class'=>'form-control')); ?>
     </div>

       </div>
      <div class="col-md-3" style ="margin-top: 2px;">
    <div class="form-group">
		<?php echo $form->label($model,'shipping_date',array('class'=>'control-label')); ?>
		<?php
    echo CHtml::textField('BookingRequest[shipping_date]',$model->shipping_date,array( 'style'=>'width:145px;','size'=>7, 'id' =>'date_end', 'class'=>'form-control'));
    ?>
	</div>
</div>

<?php $this->endWidget(); ?>

</div>
</br>
<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
    $( "#date_start" ).datepicker({
      dateFormat: "dd-mm-yy",
      defaultDate: "+1w",
      changeMonth: true,
      changeYear:true,
      numberOfMonths: 1,
      numberofYear:12,
      onClose: function( selectedDate ) {
        $( "#date_end" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#date_end" ).datepicker({
      dateFormat: "dd-mm-yy",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      changeYear:true,
      numberOfMonths: 1,
      numberofYear:12,
      onClose: function( selectedDate ) {
        $( "#date_end" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
</script>


