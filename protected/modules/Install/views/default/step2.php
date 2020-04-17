<?php $this->pageTitle = Yii::app()->name.' - Environment settings';?>
<h1>Licence File</h1>

<div class="form">

<div class="content">
<?php echo CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data'));?>
<fieldset>
<?php echo CHtml::errorSummary($model, '', '', array('class'=>'error')); ?>
<div class="input">
    <?php 
    echo CHtml::activeFilefield($model, 'licence', array('class' => 'text1'));
    ?>
    <?php if($config['error']) { echo "<span class='error'>".$config['error']."</span>"; } ?>
    <div class="note">Licence file given by the eCare SofTech Pvt. Ltd.</div>
</div>

<div class="output">
    <?php echo CHtml::submitButton('Next', array('class'=>'button')); ?>
</div>
</fieldset>
<?php echo CHtml::endForm();?>
</div>
</div>