<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $category_id
 * @property string $date_created
 * @property string $short_description
 * @property string $text
 * @property string $small_image
 * @property string $large_image
 * @property integer $author_id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Categories $category
 * @property Users $author
 */
class News extends CActiveRecord
{
    const IMG_LARGE = 'large';
    const IMG_SMALL = 'small';

    const IMG_LARGE_WIDTH  = 800;
    const IMG_LARGE_HEIGHT = 600;

    const IMG_SMALL_WIDTH  = 150;
    const IMG_SMALL_HEIGHT = 100;

    const IMG_LARGE_MOCK   = '/images/noimage-large.gif';
    const IMG_SMALL_MOCK   = '/images/noimage-small.gif';

    public static function imageAvailableTypes(){
        return array(
            "image/jpeg" => "jpg",
            "image/png"  => "png",
            "image/gif"  => "gif",
        );
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_created, text,short_description,author_id, title', 'required'),


            //array('large_image', 'file', 'types'=>'jpg, gif, png'),
            array('large_image', 'file', 'on'=>'update',
                'types'=>'jpg,JPG',
                'allowEmpty'=>true ,
                'tooLarge'=>'Uploaded file too large. Max size '.ini_get('post_max_size'),
                'wrongType'=>'Only jpg allowed',
            ),
            array('large_image', 'file',
                'on'=>'insert',
                'types'=>'jpg,JPG',
                'allowEmpty'=>false ,
                'tooLarge'=>'Uploaded file too large. Max size '.ini_get('post_max_size'),
                'wrongType'=>'Only jpg allowed',
            ),



			array('category_id, author_id', 'numerical', 'integerOnly'=>true),
			array('short_description, small_image, large_image, title', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, date_created, short_description, text, small_image, large_image, author_id, title', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Категория',
			'date_created' => 'Дата создания',
			'short_description' => 'Краткое описание',
			'text' => 'Текст',
			'small_image' => 'Превью изображения',
			'large_image' => 'Изображение',
			'author_id' => 'Автор',
            'title' => 'Заголовок',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('small_image',$this->small_image,true);
		$criteria->compare('large_image',$this->large_image,true);
		$criteria->compare('author_id',$this->author_id);
        $criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
