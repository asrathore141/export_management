<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
     'enableAjaxValidation'=>false,
     'enableAjaxValidation'=>false,
      'action'=>Yii::app()->createUrl('bookingRequest/additems', array('vid' => $vendor->vendor_id)),
)); ?>
<h3><b>Add Items</b></h2>
<div class="row">
  <div class="col-4">
  <div class="form-group">
      <?php echo $form->labelEx($items,'Select Item',array('class'=>'control-label')); ?>	
      <?php $item_array = Items::model()->findAll();
        $this->widget('ext.yii-selectize.YiiSelectize', array(
          'model'   => $items,
          'value'   => $items->item_id,
          'name'    => 'ContainerItems[item_id]',
          'data'    => CHtml::listData($item_array, 'item_id','name'),
          'cssTheme'  => 'default',
          'placeholder'=>'Select Item *',
            'htmlOptions'=>array(
               'class'=>'control-label'
             ),
         
          ));
         ?>
		</div>
  </div>
	
      <div class="col-4">
        <div class="form-group">
               <?php echo $form->labelEx($items,'Select Container',array('class'=>'control-label')); ?>
             <?php $container_array = Container::model()->findAll(array('select'=>'container_id,container_no','condition'=>'booking_id = "0" AND vendor_id = '.$vendor->vendor_id));
                $this->widget('ext.yii-selectize.YiiSelectize', array(
                    'model'   => $items,
                    'value'   => $items->container_id,
                    'name'    => 'ContainerItems[container_id]',
                    'data'    => CHtml::listData($container_array, 'container_id', 'container_no'),
                    'cssTheme'  => 'default',
                    'placeholder'=>'Select Container',
                    'htmlOptions'=>array(
                    'class'=>'control-label'
                         ),
         
                      ));
                ?>
        </div>
      </div> 
      <div class="clear clearfix"></div>

     <div id="client_info" style='color:#fff;'></div>
      <br>
      <div class="col-5">
      
    			<?php echo CHtml::submitButton($items->isNewRecord ? 'ADD' : 'Save',array('class'=>'btn btn-primary')); ?>
    	</div>
</div>
		<?php $this->endWidget(); ?>
      <br>
    <?php
			$this->renderPartial('//items/grid',array('items'=>$items));
		?>