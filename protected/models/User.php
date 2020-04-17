<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $email
 * @property string $password
 * @property string $creation_date
 * @property string $update_date
 * @property string $full_name
 * @property integer $vendor_id
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $email_id
 * @property string $company_name
 * @property string $gst_no
 * @property string $role
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, creation_date', 'required'),
			array('vendor_id', 'numerical', 'integerOnly'=>true),
			array('email, password, full_name, phone, mobile, email_id, company_name, gst_no, role', 'length', 'max'=>255),
			array('update_date, address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, email, password, creation_date, update_date, full_name, vendor_id, address, phone, mobile, email_id, company_name, gst_no, role', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'email' => 'Email',
			'password' => 'Password',
			'creation_date' => 'Creation Date',
			'update_date' => 'Update Date',
			'full_name' => 'Full Name',
			'vendor_id' => 'Vendor',
			'address' => 'Address',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email_id' => 'Email',
			'company_name' => 'Company Name',
			'gst_no' => 'Gst No',
			'role' => 'Role',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('gst_no',$this->gst_no,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function TotalBill(){
		$records = $this->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->net_amount;
        }
        return $total;
	}

	public function TotalPaid(){
		$records = $this->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->amount;
        }
        return $total;
	}

	public function TotalContainer(){
		$records = $this->search()->getData();
        $total = 0;
        foreach ($records as $record) {
            $total += $record->container_count;
        }
        return $total;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
