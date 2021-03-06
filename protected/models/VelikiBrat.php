<?php

/**
 * This is the model class for table "veliki_brat".
 *
 * The followings are the available columns in table 'veliki_brat':
 * @property integer $id
 * @property integer $id_korisnik
 * @property string $datum_vrijeme
 * @property string $opis
 *
 * The followings are the available model relations:
 * @property Korisnik $idKorisnik
 */
class VelikiBrat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VelikiBrat the static model class
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
		return 'veliki_brat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_korisnik, datum_vrijeme, opis', 'required'),
			array('id_korisnik', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_korisnik, datum_vrijeme, opis', 'safe', 'on'=>'search'),
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
			'idKorisnik' => array(self::BELONGS_TO, 'Korisnik', 'id_korisnik'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_korisnik' => 'Id Korisnik',
			'datum_vrijeme' => 'Datum Vrijeme',
			'opis' => 'Opis',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_korisnik',$this->id_korisnik);
		$criteria->compare('datum_vrijeme',$this->datum_vrijeme,true);
		$criteria->compare('opis',$this->opis,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function upisiLog($log){
		$bigBrother = new VelikiBrat;
		$bigBrother->id_korisnik = Yii::app()->user->id;
		$bigBrother->datum_vrijeme = Html::vrijemeZaBazu();
		$bigBrother->opis = $log;
		$bigBrother->save();
		return true;
		
	}
}