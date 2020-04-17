<?php

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

?>

<?php $form=$this->beginWidget('CActiveForm', array(
   'id'=>'items-form',
   'enableAjaxValidation'=>false,
   'htmlOptions' => array('enctype' => 'multipart/form-data'),
   
   )); ?>
<div  id ="additem">
  <h2 style="border-bottom: 2px solid #0000003d;">Add <span style="color:#1f75d3;">Items</span><img src="<?php echo $baseUrl ;?>/img/items.png" style="position:relative;top: -9px;" height="70" alt="Current Credit"></h2>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'name',array('size'=>40, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'name'); ?>
         </div>
         <div class="form-group">
            <?php echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'type',array('size'=>40, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'type'); ?>
         </div>
         <br>
          <div class="form-group">
            <?php echo $form->labelEx($model,'photo',array('class'=>'control-label')); ?>
            <?php echo $form->FileField($model,'photo',array('size'=>30,'maxlength'=>45),array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'photo'); ?>
            <p>Upload Passport Size Photo Max 1 MB</p>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php echo $form->labelEx($model,'color',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'color',array('size'=>30, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'color'); ?>
         </div>
         <div class="form-group">
            <?php echo $form->labelEx($model,'unit',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'unit',array('size'=>30, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'unit'); ?>
         </div>
        
     </div>
     <div class="col-md-4">
       	<div class="form-group">
            <?php echo $form->labelEx($model,'size',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'size',array('size'=>30, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'size'); ?>
         </div>
         <div class="form-group">
            <?php echo $form->labelEx($model,'thickness',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'thickness',array('size'=>30, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'thickness'); ?>
         </div>
      </div>
         <div class="col-2">
         <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
      </div>
     </div>
   </div>
<?php $this->endWidget(); ?>
