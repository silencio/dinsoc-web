<?php

/**
 * This is the model class for table "dinsoc.provider".
 *
 * The followings are the available columns in table 'dinsoc.provider':
 * @property integer $provider_id
 * @property string $name
 * @property integer $priority
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property PlaceProvider[] $placeProviders
 */
class Provider extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Provider the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dinsoc.provider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, priority, code', 'required'),
			array('priority', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('code', 'length', 'max'=>10),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('provider_id, name, priority, code, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'placeProviders' => array(self::HAS_MANY, 'PlaceProvider', 'provider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_id' => 'Provider',
			'name' => 'Name',
			'priority' => 'Priority',
			'code' => 'Code',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}