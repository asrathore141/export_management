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
         <?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
         <?php echo $form->textField($model,'name',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'name'); ?>
      </div>
      <div class="form-group">
         <?php echo $form->labelEx($model,'mobile'); ?>
         <?php echo $form->textField($model,'mobile',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'mobile'); ?>
      </div>
      <div class="from-group" style="width: 85%;">
         <?php echo $form->labelEx($model,'address'); ?>
         <?php echo $form->textArea($model,'address',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'address'); ?>
      </div>
   </div>
   <div class="col-md-4">
      <div class="forom-group">
         <?php echo $form->labelEx($model,'Company',array('class'=>'control-label'));?>
         <?php echo $form->textField($model,'company_name',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'company_name'); ?>
      </div>
      <br>
      <div class="form-group">
         <?php echo $form->labelEx($model,'phone'); ?>
         <?php echo $form->textField($model,'phone',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'phone'); ?>
      </div>
          <div class="form-group">
         <?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
         <?php echo $form->textField($model,'password',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'password'); ?>
      </div>
   </div>
   <div class="col-md-4">
      <div class="form-group">
         <?php echo $form->labelEx($model,'email'); ?>
         <?php echo $form->textField($model,'email',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'email'); ?>
      </div>
      <div class="from-group">
         <?php echo $form->labelEx($model,'gst_no'); ?>
         <?php echo $form->textField($model,'gst_no',array('size'=>40, 'class'=>"form-control form-control-sm" )); ?>
         <?php echo $form->error($model,'gst_no'); ?>
      </div>
      <br>
        <div class="from-group">
         <?php echo $form->labelEx($model,'role',array('class'=>'control-label')); ?>
         <?php
            $types = array(
              'user' => 'User',
            );
            $this->widget('ext.yii-selectize.YiiSelectize', array(
              'model'   => $model,
              'id'    => 'role',
              'value'   => $model->role,
              'name'    => 'User[role]',
              'data'    => $types,
              'cssTheme'  => 'default',
              'fullWidth' => false,
              'placeholder'=>'-select-',
                'htmlOptions' => array(
                'style' => 'width: 30%',
                
              ),
            ));
            ?>
         <?php echo $form->error($model,'role'); ?>
      </div>
      <br>
   </div>

   <div class="col-2">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
   </div>
   <?php $this->endWidget(); ?>
</div>
</div>