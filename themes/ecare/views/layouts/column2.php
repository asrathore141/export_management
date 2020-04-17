<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">

    <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->


  <div class="span3">
		<h1>App Statistics</h1>
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <td>Total Zone</td>
              <td>
          
              </td>
            </tr>
            <tr>
              <td width="50%">Total Schemes</td>
              <td>
      
              </td>
            </tr>
            <tr>
              <td>Approved Scheme</td>
              <td>
              
              </td>
            </tr>
          </tbody>
        </table>

        <div>
 
        </div>

    </div><!--/span-->



  </div><!--/row-->


<?php $this->endContent(); ?>