<?php

/**
 * This is the model class for table "dinsoc.place".
 *
 * The followings are the available columns in table 'dinsoc.place':
 * @property string $place_id
 * @property string $name
 * @property double $lat
 * @property double $lng
 * @property string $street_address
 * @property integer $zipcode
 * @property string $city
 * @property string $country
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property User[] $users
 * @property PlaceProvider[] $placeProviders
 */
class Place extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Place the static model class
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
		return 'dinsoc.place';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('zipcode', 'numerical', 'integerOnly'=>true),
			array('lat, lng', 'numerical'),
			array('name, street_address', 'length', 'max'=>200),
			array('city', 'length', 'max'=>50),
			array('country', 'length', 'max'=>2),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('place_id, name, lat, lng, street_address, zipcode, city, country, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'users' => array(self::MANY_MANY, 'User', 'favorite(place_id, user_id)'),
			'placeProviders' => array(self::HAS_MANY, 'PlaceProvider', 'place_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'place_id' => 'Place',
			'name' => 'Name',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'street_address' => 'Street Address',
			'zipcode' => 'Zipcode',
			'city' => 'City',
			'country' => 'Country',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('street_address',$this->street_address,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Retrieves a list of models based on lat/long proximity
	 * @return CActiveDataProvider
	 */
	public function findNearby($lat = null, $lng = null, $dist = 500, $max = 50)
	{
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition("geodist(lat,lng,$lat,$lng)<=$dist");
		$criteria->join = 'LEFT JOIN place_provider pp ON pp.place_id=t.place_id';
		$criteria->group = 't.place_id';
		
		//$criteria->limit = $max;
		
		$criteria->select = array(
			"t.*",
			"GROUP_CONCAT(pp.provider_id SEPARATOR '+') AS providers",
		);
		$criteria->order = "geodist(lat,lng,$lat,$lng)";
		$criteria->limit = $max;
				
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>false,
		));
		
	}
	
	/**
	 * Retrieves a list of models based on zip code
	 * @return CActiveDataProvider
	 */
	public function findByZip($zip = null, $max = -1)
	{
		
		if(is_null($zip) || !preg_match("/^[0-9]+$/",$zip)){
			return;
		}
		
		$criteria=new CDbCriteria;
		
		if($zip == 75000){
			$zip = 75;
		}
		
		if(strlen($zip)==2){
			//$criteria->addSearchCondition('zipcode', "$zip%");
			$criteria->addBetweenCondition('zipcode', $zip*1000, ($zip+1)*1000-1);
		}
		else{
			$criteria->addColumnCondition(array('zipcode'=>$zip));
		}
		
		$criteria->join = 'LEFT JOIN place_provider pp ON pp.place_id=t.place_id';
		$criteria->group = 't.place_id';
		
		$criteria->select = array(
			"t.*",
			"GROUP_CONCAT(pp.provider_id SEPARATOR '+') AS providers",
		);
		if($max > 0){
			$criteria->limit = $max;
		}
				
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>false,
		));
		
	}
	
	public $providers;
	
}