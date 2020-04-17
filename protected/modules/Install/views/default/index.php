<div id="welcome" class='main-content'>
    <div class="content">
    <?php echo CHtml::beginForm(); ?>
        <fieldset>
        <h2><?php echo $config['appName']; ?> Setup</h2>
		<div>
            <p> Installation Serial No. <br/>
            	<input type="text" id="date" name="serial" placeholder="xxxx xxxx xxxx xxxx xxxx" size="29" maxlength="29" />
            	<?php if($config['error']) { echo "<span class='error'>".$config['error']."</span>"; } ?><br/>
       		</p>
            <input type="submit" value="Start" class="button" />
            <br/><br/>
            <span style="">Tip : Goto Licence Center > Manage Licences for getting the Licence Key</span>
        </div>
        </fieldset>
    <?php echo CHtml::endForm(); ?>
	</div>
</div>