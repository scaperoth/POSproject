<?php

/**
 * This is the model class for table "playlist_feed".
 *
 * The followings are the available columns in table 'playlist_feed':
 * @property integer $playlist_feed_id
 * @property integer $playlist_id
 * @property integer $feed_id
 *
 * The followings are the available model relations:
 * @property Playlist $playlist
 * @property Feed $feed
 */
class PlaylistFeed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PlaylistFeed the static model class
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
		return 'playlist_feed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playlist_id, feed_id', 'required'),
			array('playlist_id, feed_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('playlist_feed_id, playlist_id, feed_id', 'safe', 'on'=>'search'),
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
			'feed' => array(self::BELONGS_TO, 'Feed', 'feed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'playlist_feed_id' => 'Playlist Feed',
			'playlist_id' => 'Playlist',
			'feed_id' => 'Feed',
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

		$criteria->compare('playlist_feed_id',$this->playlist_feed_id);
		$criteria->compare('playlist_id',$this->playlist_id);
		$criteria->compare('feed_id',$this->feed_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}