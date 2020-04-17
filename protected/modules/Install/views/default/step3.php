<?php $this->pageTitle = Yii::app()->name.' - Site basic information';?>

<h1>Admin Account Setup</h1>

<div class="form">
    <h3></h3>
    <div class="content">
    <?php echo CHtml::beginForm(''); ?>
    <fieldset>
    <?php echo CHtml::errorSummary($model, null, null, array('class'=>'error')); ?>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'full_name'); ?>
        <?php echo CHtml::activeTextField($model, 'full_name', array('class' => 'text1')); ?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'user_name'); ?>
        <?php echo CHtml::activeTextField($model, 'user_name', array('class' => 'text1')); ?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'password'); ?>
        <?php echo CHtml::activePasswordField($model, 'password', array('class' => 'text1')); ?>
    </div>

    <div class="output">
        <?php echo CHtml::submitButton('Finish', array('class'=>'button')); ?>
    </div>
    </fieldset>
    <?php echo CHtml::endForm();?>
    </div>
</div>