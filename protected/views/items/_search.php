
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
    <div class="col-4">
          <div class="form-group">
            <?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'name',array('size'=>40, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'name'); ?>
         </div>
       </div>
       <div class ="col-4">
         <div class="form-group">
            <?php echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'type',array('size'=>40, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'type'); ?>
         </div>
	</div>
</div>

<div class="col">

            <?php echo CHtml::submitButton('Search',array('class'=>'btn btn-success')); ?>
  </div>
</br>
<?php $this->endWidget(); ?>
