<?php

/**
 * This is the model class for table "booking_request".
 *
 * The followings are the available columns in table 'booking_request':
 * @property integer $booking_id
 * @property integer $vendor_id
 * @property string $destination_country
 * @property string $from_country
 * @property string $booking_date
 * @property string $shipping_date
 * @property integer $container_count
 * @property double $net_amount
 * @property double $balance_amount
 */
class BookingRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booking_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vendor_id, booking_date', 'required'),
			array('vendor_id, container_count', 'numerical', 'integerOnly'=>true),
			array('net_amount, balance_amount', 'numerical'),
			array('destination_country, from_country,status', 'length', 'max'=>255),
			array('shipping_date,delivery_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('booking_id, vendor_id,destination_country, from_country, booking_date, shipping_date, container_count, net_amount, balance_amount', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'vendor' =>array(self::BELONGS_TO, 'Vendor','vendor_id'),
			'payment' =>array(self::BELONGS_TO,'BookingPayment','payment_id'),
			'contitem' =>array(self::BELONGS_TO,'ContainerItems','ci_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'booking_id' => 'Booking',
			'vendor_id' => 'Vendor',
			'destination_country' => 'Destination Country',
			'from_country' => 'From Country',
			'booking_date' => 'Booking Date',
			'shipping_date' => 'Shipping Date',
			'container_count' => 'Container Count',
			'net_amount' => 'Net Amount',
			'balance_amount' => 'Balance Amount',
			'delivery_date'=>'Delivery Date',
			'status'=>'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($limit=true, $sort_field=false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		if ( isset( $this->booking_date ) ) {
			$this->booking_date = date("Y-m-d H:i:s",strtotime($this->booking_date));
		}

		if ( isset( $this->shipping_date ) ) {
			$this->shipping_date = date("Y-m-d",strtotime($this->shipping_date));
		}

		$criteria=new CDbCriteria;

		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('destination_country',$this->destination_country,true);
		$criteria->compare('from_country',$this->from_country,true);
		$criteria->compare('booking_date',$this->booking_date,true);
		$criteria->compare('shipping_date',$this->shipping_date,true);
		$criteria->compare('container_count',$this->container_count);
		$criteria->compare('net_amount',$this->net_amount);
		$criteria->compare('balance_amount',$this->balance_amount);
	    $criteria->compare('delivery_date',$this->delivery_date,true);
		$criteria->compare('status',$this->status,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=> $sort_field ? $sort_field : 'shipping_date ASC',
			),
			'pagination'=> $limit ? array('pageSize'=> $limit) : false,		));
	}


      public function TotalBill(){
		$records = $this->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->net_amount;
        }
        return $total;
	}
	  public function TotalTurn(){
		$records = $this->findAll();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->net_amount;
        }
        return $total;
	}
	

     public function TotalBills(){

		$br = new BookingRequest;
		$br->unsetAttributes();
		$br->vendor_id = $br->vendor_id;
		$br->booking_id = $br->booking_id;
		$records = $br->findAllByAttributes(array('vendor_id'=>$this->vendor_id));
        $total = 0;
        foreach ($records as $record) {
            $total += $record->net_amount;
        }
        return $total;
	}    
	public function total_bill(){
		return $this->TotalBill();
	}

   public function total_bills(){

	    $br = new BookingRequest;
		$br->unsetAttributes();
		$br->vendor_id = $this->vendor_id;
		$records = $br->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->net_amount;
        }
        return $total;
	}

	public function total_paid(){
		$bp = new BookingPayment;
		$bp->unsetAttributes();
		$bp->vendor_id = $this->vendor_id;
		$bp->booking_id = $this->booking_id;
		return $bp->TotalPaid();
	}

	public function total_due(){
		$due = $this->total_bill() - $this->total_paid();
		return $due;
    }


   

	public function total_paids(){
		$bp = new BookingPayment;
		$bp->unsetAttributes();
		$bp->vendor_id = $this->vendor_id;
		return $bp->TotalPaid();
	}

	public function total_dues(){
		$due = $this->total_bills() - $this->total_paids();
		return $due;
	}

      function getFullName()
         {
     return 'SW/BOOK/'.$this->booking_id;
          }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookingRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
