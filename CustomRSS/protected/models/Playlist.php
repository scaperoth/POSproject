<?php

/**
 * This is the model class for table "playlist".
 *
 * The followings are the available columns in table 'playlist':
 * @property integer $playlist_id
 * @property string $playlist_name
 *
 * The followings are the available model relations:
 * @property ChannelPlaylist[] $channelPlaylists
 * @property PlaylistFeed[] $playlistFeeds
 */
class Playlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Playlist the static model class
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
		return 'playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playlist_name', 'required'),
			array('playlist_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('playlist_id, playlist_name', 'safe', 'on'=>'search'),
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
			'channelPlaylists' => array(self::HAS_MANY, 'ChannelPlaylist', 'playlist_id'),
			'playlistFeeds' => array(self::HAS_MANY, 'PlaylistFeed', 'playlist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'playlist_id' => 'Playlist',
			'playlist_name' => 'Playlist Name',
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

		$criteria->compare('playlist_id',$this->playlist_id);
		$criteria->compare('playlist_name',$this->playlist_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}