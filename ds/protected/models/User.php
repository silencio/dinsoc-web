<?php

/**
 * This is the model class for table "dinsoc.user".
 *
 * The followings are the available columns in table 'dinsoc.user':
 * @property string $user_id
 * @property string $name
 * @property string $alias
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Authority $authority
 * @property Place[] $places
 * @property Follower[] $followers
 * @property Follower[] $followers1
 * @property Foodie $foodie
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'dinsoc.user';
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
			array('name, alias', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, name, alias, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'authority' => array(self::HAS_ONE, 'Authority', 'user_id'),
			'places' => array(self::MANY_MANY, 'Place', 'favorite(user_id, place_id)'),
			'followers' => array(self::HAS_MANY, 'Follower', 'follower_id'),
			'followers1' => array(self::HAS_MANY, 'Follower', 'user_id'),
			'foodie' => array(self::HAS_ONE, 'Foodie', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'name' => 'Name',
			'alias' => 'Alias',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}