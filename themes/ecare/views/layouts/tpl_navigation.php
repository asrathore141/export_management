<?php if(!Yii::app()->user->isGuest): ?>
<div class="informer">
            <b>Welcome:</b>
                <?php echo strtoupper(Yii::app()->user->getState('user')->full_name);
      if ( Yii::app()->user->isAdmin() ){
          echo " (Admin)";
      
      }
      else {
          echo"(User)";
      }?>
      
 </div>
<?php endif; ?>
<nav class="navbar navbar-expand navbar-fixed-top">

    <div class="container-fluid">

        <div class="navbar-header">
             
            <a class="navbar-brand"  href="#"><img src="<?php echo $baseUrl ;?>/img/logo.png" alt="Current Credit"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="navbar-collapse noprint collapse offset-md-5 noprint" id="navbarsExampleDefault">
        <?php if(Yii::app()->user->isGuest): ?>



        <?php else: ?>

            <?php $this->widget('zii.widgets.CMenu',array(
                'htmlOptions'=>array('class'=>'navbar-nav noprint'),
                'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                'itemCssClass'=>'nav-item',
                'encodeLabel'=>false,
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('user/dashboard'), 'linkOptions'=>array('class'=>'nav-link') ),
                    array('label'=>'Item <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown ','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle nav-link','data-toggle'=>"dropdown"),
                        'items'=>array(
                            array('label'=>'Item Add', 'url'=> Yii::app()->createUrl('items/create'), 'linkOptions'=>array('class'=>'dropdown-item')),
                            array('label'=>'Item View', 'url'=> Yii::app()->createUrl('items/admin'), 'linkOptions'=>array('class'=>'dropdown-item')),
                         )
                    ),
                    array('label'=>'Vendor<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle nav-link','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'Vendor Add', 'url'=> Yii::app()->createUrl('vendor/create'), 'linkOptions'=>array('class'=>'dropdown-item')),
                            array('label'=>'Vendor View', 'url'=> Yii::app()->createUrl('vendor/admin'), 'linkOptions'=>array('class'=>'dropdown-item')), 
                          ),'visible' => Yii::app()->user->isAdmin() ? true : false, 
                    ),
                  array('label'=>'Booking<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle nav-link','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'Book Request', 'url'=> Yii::app()->createUrl('bookingRequest/create'), 'linkOptions'=>array('class'=>'dropdown-item')),
                            array('label'=>'Booking View', 'url'=> Yii::app()->createUrl('bookingRequest/admin'), 'linkOptions'=>array('class'=>'dropdown-item')), 
                          )
                    ),  
                    array('label'=>'My Account <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle nav-link','data-toggle'=>"dropdown"), 
                    'items'=>array(
                        array( 'linkOptions'=>array('class'=>'dropdown-item'), 'label'=>'User Id', 'url'=> Yii::app()->createUrl('user/view', array('id' => Yii::app()->user->id) ), 'visible'=>!Yii::app()->user->isGuest),
                        array( 'linkOptions'=>array('class'=>'dropdown-item'), 'label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                     array('label'=>'Help', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','id'=>'help','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle nav-link', 'data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array( 'linkOptions'=>array('class'=>'dropdown-item','target'=>'_blank'), 'label'=>'info@ecaresoftech.com', 'url'=>'mailto:info@ecaresoftech.com'),
                            array( 'linkOptions'=>array('class'=>'dropdown-item','target'=>'_blank'), 'label'=>'http://support.ecaresoftech.in', 'url'=>'http://support.ecaresoftech.in'),

                          )
                    ),
                    
                    array('label'=>'Login', 'linkOptions'=>array('class'=>'nav-link'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                ),
            )); ?>

            <?php endif; ?>
      </div>
   </div>
</nav>

