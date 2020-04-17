<div class="row-fluid">
    <div class="row">
        <div class="col-md-3">
            <h4 style="padding-left:43px;" >View Vendor #<?php echo $model->vendor_id; ?></h4>
            <?php $this->widget('zii.widgets.CDetailView', 
            array( 
            	'data'=>$model, 
            	'attributes'=>array( 
            		'name',
            		'address', 
            		'phone', 
            		'mobile', 
            		'email', 
            		'company_name',
            		 'gst_no',
               array(
                  'label' => 'Total Bill',
                  'type' => 'raw',
                  'value' => function($data){
                  return '<span class="label badge-success">'. number_format($data->total_bill(),2). '</span>';
                   }
                  ),
             array(
                  'label' => 'Total Paid',
                  'type' => 'raw',
                  'value' => function($data){
                    return '<span class="label badge-warning">'. number_format($data->total_paid(),2). '</span>';
                  }
                  ),
            array(
                'type' => 'raw',
                'label' => 'Total Due',
                'value' => function($data){
               return '<span class="label badge-danger">'. number_format($data->total_due(),2). '</span>';
                  }
                )
              ),
            )); 
           ?>
                    		 
        </div>
        <div class="col-md-9">
        <h4>Vendor Booking Record</h4>
            <?php $this->widget('zii.widgets.grid.CGridView', array(
              'dataProvider'=>$items->search(),
              'itemsCssClass' => 'table table-bordered',
              'template'=>'{items}{summary}{pager}',
              'columns'=>array(
              array(
              'value' => function($data,$row){ return ($row + 1); },
              'header'=>'#',
              'htmlOptions'=>array(
              'width'=>'2%',
              ),
              ),       
              'item.name',
              'item.unit',
              'container.container_no',
              'container.container_company',
              'booking.net_amount',
              'booking.balance_amount',
              ),
              )); ?>
        </div>
    </div>
</div>
<br>
<div class="row-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php $this->renderPartial('//bookingPayment/_form',array('bp'=>$bp)); ?>
        </div>

        <div class="col-md-9">
            <h4>Vendor Payment Record</h4>
              <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'dataProvider'=>$bp->search(),
                    'itemsCssClass' => 'table table-bordered',
                    'template'=>'{items}{summary}{pager}',
                    'columns'=>array(
                     array(
                    'value' => function($data,$row){ return ($row + 1); },
                    'header'=>'#',
                    'htmlOptions'=>array(
                      'width'=>'2%',
                    ),
                  ),
                  array(
                  'header'=>'Booking Refr/No',
                  'name'=>'booking_id',
                     ),
                     array(
                  'header'=>'Payment Mode',
                  'name'=>'details',
                     ),       
                    array(
                      'name' => 'amount',
                      'type' => 'raw',
                      'value' => function($data){
                        return '<span class="badge badge-success">'. $data->amount. '</span>';
                      }
                    ),
                  'remark',
                  'transaction_date',
                    ),
                  )); ?>

        </div>
    </div>
</div>