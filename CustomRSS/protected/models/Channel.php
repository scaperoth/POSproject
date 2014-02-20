<?php

/**
 * This is the model class for table "channel".
 *
 * The followings are the available columns in table 'channel':
 * @property integer $channel_id
 * @property string $channel_name
 *
 * The followings are the available model relations:
 * @property ChannelPlaylist[] $channelPlaylists
 * @property ClientChannel[] $clientChannels
 */
class Channel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Channel the static model class
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
		return 'channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_name', 'required'),
			array('channel_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('channel_id, channel_name', 'safe', 'on'=>'search'),
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
			'channelPlaylists' => array(self::HAS_MANY, 'ChannelPlaylist', 'channel_id'),
			'clientChannels' => array(self::HAS_MANY, 'ClientChannel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'channel_id' => 'Channel',
			'channel_name' => 'Channel Name',
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

		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('channel_name',$this->channel_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}