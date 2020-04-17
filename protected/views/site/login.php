
    <?php

    $this->pageTitle=Yii::app()->name;
    $baseUrl = Yii::app()->theme->baseUrl;

    ?>
     <div class="col-4 offset-md-4" id="pay">
<h2 style="text-align: center;" >Login</h2>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'action'=>Yii::app()->createUrl('site/login'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
   
        <div class="form-group">
            <?php echo $form->labelEx($model,'Username'); ?>
            <?php echo $form->textField($model,'email',array('class' => 'form-control')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    
        <div class="form-group">
            <?php echo $form->labelEx($model,'Password'); ?>
            <?php echo $form->passwordField($model,'password',array('class' => 'form-control')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    
        <div class="from-group buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
        </div>
    
    </div><!-- form -->
<?php $this->endWidget();?>
<div class="clear clearfix"></div>