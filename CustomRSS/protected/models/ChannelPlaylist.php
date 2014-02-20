<?php

/**
 * This is the model class for table "channel_playlist".
 *
 * The followings are the available columns in table 'channel_playlist':
 * @property integer $channel_playlist_id
 * @property integer $playlist_id
 * @property integer $channel_id
 *
 * The followings are the available model relations:
 * @property Playlist $playlist
 * @property Channel $channel
 */
class ChannelPlaylist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelPlaylist the static model class
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
		return 'channel_playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playlist_id, channel_id', 'required'),
			array('playlist_id, channel_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('channel_playlist_id, playlist_id, channel_id', 'safe', 'on'=>'search'),
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
			'playlist' => array(self::BELONGS_TO, 'Playlist', 'playlist_id'),
			'channel' => array(self::BELONGS_TO, 'Channel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'channel_playlist_id' => 'Channel Playlist',
			'playlist_id' => 'Playlist',
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

		$criteria->compare('channel_playlist_id',$this->channel_playlist_id);
		$criteria->compare('playlist_id',$this->playlist_id);
		$criteria->compare('channel_id',$this->channel_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}