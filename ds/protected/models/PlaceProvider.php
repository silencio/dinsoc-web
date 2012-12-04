<?php

/**
 * This is the model class for table "dinsoc.place_provider".
 *
 * The followings are the available columns in table 'dinsoc.place_provider':
 * @property string $place_id
 * @property integer $provider_id
 * @property string $source_id
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Provider $provider
 * @property Place $place
 */
class PlaceProvider extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PlaceProvider the static model class
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
		return 'dinsoc.place_provider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('place_id, provider_id, source_id', 'required'),
			array('provider_id', 'numerical', 'integerOnly'=>true),
			array('place_id', 'length', 'max'=>10),
			array('source_id', 'length', 'max'=>100),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('place_id, provider_id, source_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'provider' => array(self::BELONGS_TO, 'Provider', 'provider_id'),
			'place' => array(self::BELONGS_TO, 'Place', 'place_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'place_id' => 'Place',
			'provider_id' => 'Provider',
			'source_id' => 'Source',
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

		$criteria->compare('place_id',$this->place_id,true);
		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('source_id',$this->source_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}