<div class="row-fluid">
    <div class="row">
        <div class="col-md-3">
            <h4 style="padding-left:57px;" >View Vendor #<?php echo $model->vendor_id; ?></h4>
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
        <h4>Booking Records 
          <?php
              echo CHtml::link(
                'Print Record',
                '#',
                array(
                  'class'=>'btn btn-primary noprint',
                  'id' => 'printme'
                )
              );
           ?>
     </h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                    'dataProvider'=>$booking->search(10),
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
                          'name'=>'booking_id',
                          'header' => 'Booking/Ref.No',
                          'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
                          'class'=>'YDataLinkColumn',
                          'value' => function($data){
                            return 'SW/BOOK/'.$data->booking_id;
                          }
                        ),
                    'from_country',
                    'destination_country',
                    'booking_date',
                    'shipping_date',
                    array(
                      'header'=>'No Of Containers',
                      'name'=>'container_count',  
                    ),
                    
                      array(
                      'header' => 'Total Bill',
                      'type' => 'raw',
                      'value' => function($data){
                        return '<span class="badge badge-success">'. number_format($data->total_bill(),2). '</span>';
                      }
                    ),
                    array(
                      'header' => 'Total Paid',
                      'type' => 'raw',
                      'value' => function($data){
                        return '<span class="badge badge-warning">'. number_format($data->total_paid(),2). '</span>';
                      }
                    ),
                    array(
                      'type' => 'raw',
                      'header' => 'Total Due',
                      'value' => function($data){
                        return '<span class="badge badge-danger">'. number_format($data->total_due(),2). '</span>';
                      }
                    ),
                  ),
                )); ?>      
          </div>     
       </div>
    </div>
</br>
<div class="row-fluid">
    <div class="row">
        <div class="col-md-3 noprint">

</div>

        <div class="col-md-9">
            <h4>Payment Records</h4>
          <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'dataProvider'=>$bp->search(),
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
                          'name'=>'booking_id',
                          'header' => 'Booking/Ref.No',
                          'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
                          'class'=>'YDataLinkColumn',
                          'value' => function($data){
                            return 'SW/BOOK/'.$data->booking_id;
                          }
                        ),
                      'amount',
                     'remark',
                     array(
                    'header'=>'Payment',
                     'name' =>'details',
                      ),
                     'transaction_date',
                  ),
                )); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
});
</script>