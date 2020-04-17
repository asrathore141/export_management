<?php

class BookingRequestController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','view','vendorview','take','addcontainer','additems','completebooking','payment','addpayment','status'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
		public function actionAddPayment($id)
	{

       if(isset($_POST['BookingPayment']) ) 

        {
        	if ( !$_POST['BookingRequest']['booking_id'] ) {
				return $this->redirect(array('view','id'=>$id));
        	}


         	$bookingId = $_POST['BookingRequest']['booking_id'];
         	$amount = $_POST['BookingPayment']['amount'];

			foreach($bookingId as $booking_id)
			{
				// Find out booking dues
				$booking = BookingRequest::model()->findByPk($booking_id);
				$booking_due_amount = $booking->total_dues();

				$bp = new BookingPayment('search');
				$bp->unsetAttributes();
		 		$bp->attributes = $_POST['BookingPayment'];
		 		$bp->booking_id = $booking_id;
		 		$bp->vendor_id = $id;
		 		$bp->transaction_date =date('Y-m-d H:i:s');
		 		$bp->amount = 0;

				$balance = $amount - $booking_due_amount;

				if ( $balance < 0 ) {
					$bp->amount = $amount;
				}
				elseif( $amount > 0 ) {
					$bp->amount = $booking_due_amount;
				}

				if ( $bp->amount  > 0 ) {
						if ( sizeof($bookingId) > 1 ){
						$bp->remark = $bp->remark . ' as Bulk Payment';	
					}

					if ( !$bp->save() ) {
						var_dump( $bp->getErrors() );
					}
					else {
						$amount = $balance;
					}
				}

		        $due = $booking->total_due();
		        $booking->balance_amount = $due;
		        $booking->update();

			
			}
     	}
		$this->redirect(array('vendorview','id'=>$id));
	}


public function actionContainerItem($id)
	{
	   $model = $this->loadModel($id);	


       $booking = new BookingRequest('search');
	   $booking->unsetAttributes();
	   $booking->vendor_id = $id;

	   $container = new Container('search');
	   $container->unsetAttributes();
	   $container->vendor_id = $id;
        	
   
	   $items = new ContainerItems('search');
	   $items->unsetAttributes();
	   $items->vendor_id = $id;

	   $bp = new BookingPayment; 
	   $bp->unsetAttributes();
 		$bp->vendor_id = $id;  

		$this->render('containeritem',array(
			'model'=>$this->loadModel($id),
			'items'=>$items,
			'booking'=>$booking,
			'bp' =>$bp,
			'container' =>$container,
		));
	}

	public function actionVendorView($vendorid)
	{
	
		$model=Vendor::model()->findByPk($vendorid);

		$br = new BookingRequest('search'); 
		$br->unsetAttributes();
		$br->vendor_id = $model->vendor_id;
 
 		$bp = new BookingPayment('search'); 
		$bp->unsetAttributes();
		$bp->vendor_id = $model->vendor_id;

		$this->render('vendorview',array(
			'model'=>$model,
			'booking' =>$br,
			'bp' => $bp,
		));
	}
		

	public function actionView($id)
	{
	   $model = $this->loadModel($id);	

	   $bp = new BookingPayment; 
	   $bp->unsetAttributes();
 	   $bp->vendor_id = $model->vendor_id;
 	   $bp->booking_id = $model->booking_id;

	 $this->render('view',array(
			'model'=>$model,
			'bp'=>$bp,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */


	public function actionTake($vid)
	{

		if ( !Yii::app()->user->isAdmin() ){
			$vid = Yii::app()->user->getState('user')->user_id;

		}

		$vendor = Vendor::model()->findByPk($vid);
		$this->render('take',array(
			'vendor' => $vendor,
		));
	}
   
     public function actionAddContainer($vid)
    {
        $vendor = Vendor::model()->findByPk($vid);

		$container = new Container;
		$container->vendor_id = $vendor->vendor_id;

		if(isset($_POST['Container']))
		{
			$container->attributes = $_POST['Container'];
			$container->booking_id = 0000;

			if ($container->save()) {
				$this->redirect(array('take','vid' => $vendor->vendor_id));
			}
			else{
				var_dump( $container->getErrors() );
				die;
			}
       }
		$this->redirect(array('take','vid' => $vendor->vendor_id));
	}


 public function actionAddItems($vid)
    {
        $vendor = Vendor::model()->findByPk($vid);

		$items = new ContainerItems;
		$item = new  Items;
		$container = new Container;

	    $items->vendor_id  = $vendor->vendor_id;
	    $items->container_id =$container->container_id;
	    $items->item_id =$item->item_id; 

		if(isset($_POST['ContainerItems']))
		{
			$items->attributes = $_POST['ContainerItems'];
			$items->booking_id = 0000;
			$items->entry_date= date('Y-m-d H:i:s');

			if ($items->save()) {
				$this->redirect(array('take','vid' => $vendor->vendor_id,'#'=>'yw4_tab_1'));
			}			
       }
		
	}

	

 	public function actionCompleteBooking($vid)
    {
        $vendor = Vendor::model()->findByPk($vid);

        $model = new BookingRequest;
        $model->vendor_id  =$vendor->vendor_id;
        $model->status = 'Booked';

        $bp = new BookingPayment;
	    $bp->booking_id =$model->booking_id;
	    $bp->vendor_id  =$vendor->vendor_id;
	   
		if(isset($_POST['BookingRequest']))
		{
			$model->attributes = $_POST['BookingRequest'];

			if ( isset($model->shipping_date) ) {
				$model->status = 'Shipped';
			}

			if ($model->save()) {

				Container::model()->updateAll(array(
					'booking_id' => $model->booking_id
				), "booking_id=0 AND vendor_id=".$model->vendor_id );

				ContainerItems::model()->updateAll(array(
					'booking_id' => $model->booking_id
				), "booking_id=0 AND vendor_id=".$model->vendor_id );

				$bp->attributes = $_POST['BookingPayment'];
				$bp->booking_id = $model->booking_id;
			    $bp->vendor_id  =$vendor->vendor_id;
			    $bp->transaction_date = date('Y-m-d H:i:s');

				$bp->save();

				$this->redirect(array('admin','vid' => $vendor->vendor_id));
			}
			else{
				var_dump( $model->getErrors() );
				die;
			}
		}
	}

	public function actionPayment($id)

	{

       $model = BookingRequest::model()->findByPk($id);
       $bp = new BookingPayment;
       $bp->booking_id=$model->booking_id;
       $bp->vendor_id = $model->vendor_id;
                

       if (isset($_POST['BookingPayment'])) {
                $bp->attributes = $_POST['BookingPayment'];
                $bp->booking_id  = $model->booking_id;
                $bp->vendor_id = $model->vendor_id;
                $bp->transaction_date =date('Y-m-d H:i:s');
                $bp->save(false);
        }

        $due = $model->total_due();
        $model->balance_amount = $due;
        $model->update();

            $this->redirect(array(
                'view',
                 'id' => $model->booking_id
                
            ));   
    }


	 public function actionCreate()
	   {
		$model=new BookingRequest('search');

		$model->unsetAttributes();

		if ( !Yii::app()->user->isAdmin() ){
			$this->redirect(array('take','vid'=> Yii::app()->user->getState('user')->user_id));
		}

		if (isset($_GET['BookingRequest'])) {
			$model->attributes=$_GET['BookingRequest'];
		}

		$this->render('create',array(
			'model'=>$model,
		));
	} 
	 

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BookingRequest']))
		{
			$model->attributes=$_POST['BookingRequest'];
			
            if ($model->status == 'Delivered') {
               	$model->delivery_date =date('Y-m-d H:i:s');
            }
			if($model->save())
				$this->redirect(array('vendorview','id'=>$model->booking_id));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BookingRequest');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BookingRequest('search');
		$model->unsetAttributes();  // clear any default values

		if ( !Yii::app()->user->isAdmin() ){
			$model->vendor_id = Yii::app()->user->getState('user')->user_id;
		}

		if(isset($_GET['BookingRequest']))
			$model->attributes=$_GET['BookingRequest'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BookingRequest the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BookingRequest::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BookingRequest $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='booking-request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
