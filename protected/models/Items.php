<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $item_id
 * @property string $name
 * @property string $type
 * @property string $size
 * @property string $thickness
 * @property string $color
 * @property string $unit
 * @property string $photo
 * @property string $entry_date
 * @property integer $user_id
 */
class Items extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, entry_date, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name, type, size, thickness, color, unit, photo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_id,user_id, name, type, size, thickness, color, unit, photo, entry_date', 'safe', 'on'=>'search'),
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
			'item_id' => 'Item',
			'name' => 'Name',
			'type' => 'Type',
			'size' => 'Size',
			'thickness' => 'Thickness',
			'color' => 'Color',
			'unit' => 'Unit',
			'photo' => 'Photo',
			'entry_date' => 'Entry Date',
			'user_id' => 'User',
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
	public function search($limit=false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;


		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('thickness',$this->thickness,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function photo(){
		return Yii::app()->request->baseUrl ."/files/items/".$this->item_id."/".$this->photo;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Items the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
