<?php

/**
 * This is the model class for table "feed".
 *
 * The followings are the available columns in table 'feed':
 * @property integer $feed_id
 * @property string $feed_name
 * @property string $feed_url
 * @property string $feed_image
 *
 * The followings are the available model relations:
 * @property PlaylistFeed[] $playlistFeeds
 */
class Feed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feed the static model class
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
		return 'feed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('feed_name, feed_url', 'required'),
			array('feed_name', 'length', 'max'=>45),
			array('feed_url, feed_image', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('feed_id, feed_name, feed_url, feed_image', 'safe', 'on'=>'search'),
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
			'playlistFeeds' => array(self::HAS_MANY, 'PlaylistFeed', 'feed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'feed_id' => 'Feed',
			'feed_name' => 'Feed Name',
			'feed_url' => 'Feed Url',
			'feed_image' => 'Feed Image',
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

		$criteria->compare('feed_id',$this->feed_id);
		$criteria->compare('feed_name',$this->feed_name,true);
		$criteria->compare('feed_url',$this->feed_url,true);
		$criteria->compare('feed_image',$this->feed_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}