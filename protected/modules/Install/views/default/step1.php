<?php 
$this->pageTitle = Yii::app()->name.' - System checks';
$next = true;
?>
<?php echo CHtml::beginForm(array('default/step2')); ?>
<h1>System checks</h1>
<div class="form">
    <div class="content">
    <fieldset>
    <div class="emphasize">Check if eCare Application is compatible with your environment</div>
    <ol>
       <li>Web server ... OK</li>
       <li>PHP 5 and required modules ... OK</li>
    </ol>
    <br/>
    <div class="note">
        <div class="emphasize">The following folders must be writable:</div>
        <ul>
            <?php
            foreach ($folders as $folder => $writable):
                if ($writable === false) $next = false;
            ?>
                <li><?php echo realpath($folder);?> - <?php echo $writable===false ? 'NOT OK' : '<span style="color:green">OK</span>';?></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php if ($next === false) : ?>
    <div class="note">Make sure all folders listed above exist and are writable before start.</div>
    <?php endif; ?>
    </fieldset>
</div>
</div>
<h1 style="margin-top: 0px;">License Agreement</h1>
<div class="form">
    <div class="content">
        <fieldset>
            <div style="height: 100px; width: 524px; overflow: scroll; overflow-x:hidden; border: 1px solid gray; padding: 5px; font-size: 1.2em; margin: 0 auto;">
            <?php
            $copyright = Yii::getPathOfAlias('webroot').'/copyright.txt';
            if (file_exists($copyright)):?>
                <?php echo '<pre>'.CHtml::encode(file_get_contents($copyright)).'</pre>';?>
            <?php endif;?>
            </div>
        <?php if ($next === true) : ?>
        <div class="note" style="text-align: center;">By clicking Next, you agree to the terms stated in the Open-School License Agreement above.</div>

        <div class="output" style="padding-left: 0; text-align: center;">        
            <?php echo CHtml::submitButton('Next', array('class'=>'button'));?>
        </div>

        <?php endif; ?>
        </fieldset>
    </div>
</div>
<?php CHtml::endForm(); ?>