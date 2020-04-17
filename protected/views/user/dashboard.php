<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

?>
<?php

$user_id = Yii::app()->user->getState('user')->user_id;
$payment_come ="";
$turn_over ="";
$total_booking = "";

$booking_request = new BookingRequest;
$booking_request->unsetAttributes();

if( !Yii::app()->user->isAdmin() ) {
  $booking_request->vendor_id = $user_id;
  $total_booking = "vendor_id = $user_id";
}

?>
<div class="row">
<div class="col-3">
        <h3>App Stats</h3>
        <div class="summary">
          <ul>
            <li>             
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/item.png" width="36" height="36" alt="Current Credit">
                </span>
                <span class="summary-number"><?php echo Items::Model()->count(); ?></span>
                <span class="summary-title">Total Items</span>
                </a>
            </li>
          <?php if( Yii::app()->user->isAdmin() ): ?>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/vendor.png" width="36" height="36" alt="Current Debit">
                </span>
                <span class="summary-number"><?php echo Vendor::Model()->count(); ?></span>
                <span class="summary-title"> Total Vendors</span>
               </a>
            </li> 
          <?php endif; ?>
             <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/payment.png" width="36" height="36" alt="Current Credit">
                </span>
                <span class="summary-number">$<?php echo $booking_request->total_paids();?></span>
                <span class="summary-title"> Payment Come</span>
                </a>
            </li>
            <?php if( !Yii::app()->user->isAdmin() ): ?> 
             <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/turn.png" width="36" height="36" alt="Current Credit">
                </span>
                <span class="summary-number">$<?php echo $booking_request->TotalBills();?></span>
                <span class="summary-title">Turn Over</span>
                </a>
            </li>
             <?php endif; ?>
            <?php if( Yii::app()->user->isAdmin() ): ?> 
              <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/turn.png" width="36" height="36" alt="Current Credit">
                </span>
                <span class="summary-number">$<?php echo $booking_request->TotalTurn();?></span>
                <span class="summary-title">Turn Over</span>
                </a>
            </li>
            <?php endif; ?>
             <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/booking.png" width="36" height="36" alt="Current Credit">
                </span>
                <span class="summary-number"><?php echo BookingRequest::Model()->count($total_booking);?></span>
                <span class="summary-title">Total Booking</span>
                </a>
            </li>          
        </ul>
        </div>

    </div>

    <div class="col-9">
      <h3>Payment Due Record</h3>
      <?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'booking-request-grid',
  'dataProvider'=>$model->search(5),
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
       'header'=>'Booking Id',
        'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
        'class'=>'YDataLinkColumn',
        'value' => function($data){
        return 'SW/BOOK/'.$data->booking_id;
      }
        ),
    array(
      'header' => 'Vendor',
      'name'=>'vendor.name',
        'urlExpression'=>'array("bookingRequest/view","id"=>$data->booking_id)',
      'class'=>'YDataLinkColumn',
    ),
    array(
    'name'=>'booking_date',
    'value'=>'date_format(date_create($data->booking_date), "j M, Y ")'
          ),
    array(
    'name'=>'shipping_date',
    'value'=>'date_format(date_create($data->shipping_date), "j M, Y ")'
          ),
    'status',
    array(
       'header'=>'Due  Date',
       'type' =>'raw',
       'value'=> function($data){

            $today = $data->shipping_date;
            $color = 'red'; // Or can put $today = date ("Y-m-d");

      $fiveDays = date ("j M, Y", strtotime ($today ."+90 days"));
      return "<span style='color:$color'><b> $fiveDays </b>&nbsp;";
       
       },
    ),
    
    
    array(
      'header' => 'Total Bill',
      'type' => 'raw',
      'value' => function($data){
        return '<span class="badge badge-success">'.'$'. number_format($data->total_bill(),2). '</span>';
      }
    ),
    array(
      'header' => 'Total Paid',
      'type' => 'raw',
      'value' => function($data){
        return '<span class="badge badge-warning">'.'$'. number_format($data->total_paid(),2). '</span>';
      }
    ),
    array(
      'type' => 'raw',
      'header' => 'Total Due',
      'value' => function($data){
        return '<span class="badge badge-danger">'.'$'. number_format($data->total_due(),2). '</span>';
      }
    ),
  ),
)); ?>
    </div>
</div>
