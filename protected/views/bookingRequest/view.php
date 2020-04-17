
    <div class="row">
        <div class="col-md-3">
            <h4 style="padding-left:57px;" >View Vendor #<?php echo $model->vendor_id; ?></h4>
            <?php $this->widget('zii.widgets.CDetailView', 
            array( 
              'data'=>$model, 
              'attributes'=>array( 
                'vendor.name',
                'vendor.mobile', 
                'vendor.email', 
                'vendor.company_name',
                  ),
                )); 
               ?>
           <br/>
          <div class="">
      <h4 style="padding-left:57px;" >Booking Detail</h4>
            <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model, 
                    'attributes'=>array(
                      array(
                          'name'=>'booking_id',
                          'label' => 'Booking/Ref.No',
                          'class'=>'YDataLinkColumn',
                          'value' => function($data){
                           return 'SW/BOOK/'.$data->booking_id;
                          }
                        ),
                      'from_country',
                      'destination_country',
                      array(
                       'name'=>'booking_date',
                       'value'=>date('j M, Y,',strtotime($model->booking_date)),
                          ),
                       array(
                       'name'=>'shipping_date',
                       'value'=>date('j M, Y,',strtotime($model->shipping_date)),
                          ),
                        array(
                        'label' => 'Total Bill',
                        'type' => 'raw',
                        'value' => function($data){
                          return '<span class="badge badge-success">'.'$'. number_format($data->total_bill(),2). '</span>';
                        }
                      ),
                      array(
                        'label' => 'Total Paid',
                        'type' => 'raw',
                        'value' => function($data){
                          return '<span class="badge badge-warning">'.'$'. number_format($data->total_paid(),2). '</span>';
                        }
                      ),
                      array(
                        'type' => 'raw',
                        'label' => 'Total Due',
                        'value' => function($data){
                          return '<span class="badge badge-danger">'.'$'. number_format($data->total_due(),2). '</span>';
                        }
                      ),
                    ),
                  )); ?>
          </div>  

        </div>  

    <div class="col-md-9">

    <div class="row">
        <div class="col-md-4 row">
            <span style="font-size: 18px;color:green;">BOOKING STATUS: <b><?php echo $model->status ? $model->status : 'Booked'; ?></b></span>
        </div>
        <div class="col-md-4">
            <?php
               echo CHtml::link('Add Payment', '#', array(
                 'onclick'=>'$("#mydialog1").dialog("open"); return false;',
                 'class' => 'btn btn-success noprint'
               ));
               echo "&nbsp;";
              echo CHtml::link('Print Record', '#', array(
                'class'=>'btn btn-primary noprint',
                'id' => 'printme'
              ));
            ?>
        </div>
        <div class="col-md-4">
            <?php if( Yii::app()->user->isAdmin() ): ?>

                 <?php $form=$this->beginWidget('CActiveForm', array(
                    'enableAjaxValidation'=>false,
                    'action'=>Yii::app()->createUrl('bookingRequest/update', array(
                      'id'=>$model->booking_id,
                    )),
                    ));

                   $this->widget('ext.yii-selectize.YiiSelectize', array(
                       'model'  => $model,
                       'id' => 'status',
                       'value'  => $model->status,
                       'name'  => 'BookingRequest[status]',
                       'data'   => array(
                          'Booked' => 'Booked',
                          'Shipped' => 'Shipped',
                          'Delivered' => 'Delivered',
                          'Canceled' => 'Canceled'

                       ),
                     
                   ));
                       ?>
                  <?php echo CHtml::submitButton('Set Status', array('class'=>'btn btn-danger')); ?>
                 <?php $this->endWidget(); ?>
            <?php endif; ?>
        </div>
    </div>                


      <div class="row" style="page-break-after: always ;">
        <?php
           $container = new Container('search');
           $container->unsetAttributes();
           $container->vendor_id = $model->vendor_id;
           $container->booking_id = $model->booking_id;

           foreach ($container->search()->getData() as $d) {

              echo "<div class='col-md-6 conts'>";

                $this->renderPartial('//container/_view',array('model'=>$d));

                 $items = new ContainerItems('search');
                 $items->unsetAttributes();
                 $items->vendor_id = $model->vendor_id;
                 $items->booking_id = $model->booking_id;
                 $items->container_id = $d->container_id;

                 echo "<h5>Items Store</h5>";

                 $this->widget('zii.widgets.grid.CGridView', array(
                          'id'=>'itm',
                          'template'=>'{items}{summary}{pager}',
                          'dataProvider'=>$items->search(),
                          'columns'=>array(
                          array(
                            'header'=>'Items',
                            'name'=>'item.name',
                              ),
                            'item.type',
                            'item.size',
                            'item.thickness',
                            'item.color',
                            'item.unit',
                          
                          ),
                        )); 

              echo "</div>";

           }

        ?>
      </div>
      <br>
      <div class="row">
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

<script type="text/javascript">
$(function() {
  $('#printme').click( function(e){
    e.preventDefault();
    window.print();
  });
});
</script>


<?php 
  $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
   'id'=>'mydialog1',
   'options'=>array(
     'title'=>'Add Payment',
     'autoOpen'=>false,
     'width'=> '60%',
     'height' => '400',
     'modal' => true,
   )
  ));

  $this->renderPartial('payment',array(
'bp'=> $bp,'booking_id'=>$model->booking_id)); 

  $this->endWidget('zii.widgets.jui.CJuiDialog');
?>