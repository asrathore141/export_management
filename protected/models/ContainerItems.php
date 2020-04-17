<?php

/**
 * This is the model class for table "container_items".
 *
 * The followings are the available columns in table 'container_items':
 * @property integer $ci_id
 * @property integer $container_id
 * @property integer $item_id
 * @property string $entry_date
 * @property integer $booking_id
 * @property integer $vendor_id
 */
class ContainerItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'container_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('container_id, item_id, entry_date, booking_id, vendor_id', 'required'),
			array('container_id, item_id, booking_id, vendor_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ci_id, container_id, item_id, entry_date,booking_id, vendor_id', 'safe', 'on'=>'search'),
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
	    'container' =>array(self::BELONGS_TO, 'Container','container_id'),
	   	'booking' =>array(self::BELONGS_TO, 'BookingRequest','booking_id'),
         'item' =>array(self::BELONGS_TO, 'Items','item_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ci_id' => 'Ci',
			'container_id' => 'Container',
			'item_id' => 'Item',
			'entry_date' => 'Entry Date',
			'booking_id' => 'Booking',
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

		$criteria->compare('ci_id',$this->ci_id);
		$criteria->compare('container_id',$this->container_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('vendor_id',$this->vendor_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContainerItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
