<div class="row-fluid">
    <div class="row">
        <div class="col-md-3">
            <h4 style="padding-left:57px;" >View Vendor #<?php echo $model->vendor_id; ?></h4>
            <?php $this->widget('zii.widgets.CDetailView', 
            array( 
            	'data'=>$booking, 
            	'attributes'=>array( 
            		'vendor.name',
            		'vendor.address', 
            		'vendor.phone', 
            		'vendor.mobile', 
            		'vendor.email', 
            		'vendor.company_name',
            		 'vendor.gst_no',
              ),
            )); 
           ?>
                    		 
        </div>
         <div class="col-md-9">
        <h4>Vendor Containers Records</h4>
        <?php

      $cont = Container::model()->findAllByAttributes(array(
      'vendor_id' => $container->vendor_id
      ));
      ?>
      <div class="row">
      <?php

     // print_r($cont); die;
      foreach ($cont as $keys) 
      { ?>
          <div  class="col-sl-3" style="border-style: ridge;border-color: #5abff8;border-width: 8px;">
        <?php

        $conts = ContainerItems::model()->findAllByAttributes(array('container_id'=>$keys->container_id));
            // print_r($conts[0]->item_id); die;
          echo "Container No:"."$keys->container_no"."<br>";
                 
              foreach ($conts as $key){ 
         
                 

        $items = Items::model()->findAllByAttributes(array('item_id' =>$key->item_id));

             foreach($items as $keyss)
             {
              $itemname =$keyss->name;
              $date = $key->entry_date;
                  echo "Date:"."$key->entry_date"."<br>";
                  echo "Item:"."$itemname"."<br>";                
             }
                    echo '<tr>';
                    echo '<td>'. $row['name'] . '</td>';
                    echo '<td>'. $itemname['email'] . '</td>';
                    echo '<td>'. $date['mobile'] . '</td>';
                    echo '</tr>';

           }
         ?>
    </div><p>&nbsp;</p>
         <?php  
               }
          ?>
   </div> 

        </div>
    </div>
</div>