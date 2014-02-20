<?php

/**
 * This is the model class for table "client_channel".
 *
 * The followings are the available columns in table 'client_channel':
 * @property integer $client_channel_id
 * @property integer $client_id
 * @property integer $channel_id
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Channel $channel
 */
class ClientChannel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClientChannel the static model class
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
		return 'client_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, channel_id', 'required'),
			array('client_id, channel_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('client_channel_id, client_id, channel_id', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
			'channel' => array(self::BELONGS_TO, 'Channel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'client_channel_id' => 'Client Channel',
			'client_id' => 'Client',
			'channel_id' => 'Channel',
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

		$criteria->compare('client_channel_id',$this->client_channel_id);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('channel_id',$this->channel_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}