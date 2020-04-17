<?php

/**
 * This is the model class for table "vendor".
 *
 * The followings are the available columns in table 'vendor':
 * @property integer $vendor_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $company_name
 * @property string $gst_no
 * @property string $entry_date
 * @property string $update_date
 * @property string $role
 * @property string $password
 */
class Vendor extends CActiveRecord
{
	public $user_id;
	public $full_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vendor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gst_no', 'length', 'max'=>16),
			array('mobile', 'length', 'max'=>10),
			   array('email ','unique', 'message'=>'This email already registered with us.', 'criteria'=>array(
			        'condition'=>'`email`=:email',
			        'params'=>array(
			                ':email'=>$this->email
			        )
			)),
			array('mobile ','unique', 'message'=>'This mobile already registered with us.', 'criteria'=>array(
			        'condition'=>'`mobile`=:mobile',
			        'params'=>array(
			                ':mobile'=>$this->mobile
			        )
			)),

			array('entry_date', 'required'),
			array('name, phone, mobile, email, company_name, gst_no, role, password', 'length', 'max'=>255),
			array('address, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vendor_id, name, address, phone, mobile, email, company_name, gst_no, entry_date, update_date, role, password', 'safe', 'on'=>'search'),
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
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vendor_id' => 'Vendor',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'company_name' => 'Company Name',
			'gst_no' => 'Gst No',
			'entry_date' => 'Entry Date',
			'update_date' => 'Update Date',
			'role' => 'Role',
			'password' => 'Password',
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

		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('gst_no',$this->gst_no,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function TotalBill(){

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

	public function total_paid(){
		$bp = new BookingPayment;
		$bp->unsetAttributes();
		$bp->vendor_id = $this->vendor_id;
		return $bp->TotalPaid();
	}

	public function total_due(){
	
		$due = $this->total_bill() - $this->total_paid();
		return $due;
	
      }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vendor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
