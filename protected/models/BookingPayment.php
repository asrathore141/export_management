<?php

/**
 * This is the model class for table "booking_payment".
 *
 * The followings are the available columns in table 'booking_payment':
 * @property integer $payment_id
 * @property integer $booking_id
 * @property double $amount
 * @property string $payment_mode
 * @property string $cheque_dd_number
 * @property string $bank_name
 * @property string $bank_reference_no
 * @property string $remark
 * @property string $details
 * @property string $transaction_date
 * @property integer $vendor_id
 */
class BookingPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booking_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, amount,vendor_id', 'required'),
			array('booking_id, vendor_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('payment_mode, cheque_dd_number, bank_name, bank_reference_no', 'length', 'max'=>255),
			array('remark, details, transaction_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('payment_id, booking_id, amount, payment_mode, cheque_dd_number, bank_name, bank_reference_no, remark, details, transaction_date, vendor_id', 'safe', 'on'=>'search'),
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
				'Booking' =>array(self::BELONGS_TO, 'BookingRequest','booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'payment_id' => 'Payment',
			'booking_id' => 'Booking',
			'amount' => 'Amount',
			'payment_mode' => 'Payment Mode',
			'cheque_dd_number' => 'Cheque Dd Number',
			'bank_name' => 'Bank Name',
			'bank_reference_no' => 'Bank Reference No',
			'remark' => 'Remark',
			'details' => 'Details',
			'transaction_date' => 'Transaction Date',
			'vendor_id' => 'Vendor',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('payment_mode',$this->payment_mode,true);
		$criteria->compare('cheque_dd_number',$this->cheque_dd_number,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_reference_no',$this->bank_reference_no,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('transaction_date',$this->transaction_date,true);
		$criteria->compare('vendor_id',$this->vendor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function TotalPaid(){
		$records = $this->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->amount;
        }
        return $total;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookingPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
