<?php

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Base Model
 *
 * @property string $createdAt
 * @property string $createdFrom
 * @property string $updatedAt
 * @property string $updatedFrom
 * @property string $createdAtOverride
 * @property string $createdFromOverride
 * @property string $updatedAtOverride
 * @property string $updatedFromOverride
 */
class CustomActiveRecord extends ActiveRecord
{
	public $createdAtOverride = '';
	public $createdFromOverride = '';
	public $updatedAtOverride = '';
	public $updatedFromOverride = '';

	public function beforeSave($insert) {
		if(isset(\Yii::$app->user->id)){
			$uid = \Yii::$app->user->id;
		}else{
			$uid = 0;
		}
		if($insert){
			$this->createdAt = date('Y-m-d H:i:s');
			$this->createdFrom = $uid;
		}
		// Wenn Erstellt Datum überschrieben werden soll
		if(!empty($this->createdAtOverride)){
			$this->createdAt = $this->createdAtOverride;
		}
		if(!empty($this->createdFromOverride)){
			$this->createdFrom = $this->createdFromOverride;
		}
		// Änderungsdatum inkl. überschreibung
		if(empty($this->updatedAtOverride)){
			$this->updatedAt = date('Y-m-d H:i:s');
		}else{
			$this->updatedAt = $this->updatedAtOverride;
		}
		if(empty($this->updatedFromOverride)){
			$this->updatedFrom = $uid;
		}else{
			$this->updatedFrom = $this->updatedFromOverride;
		}
		return parent::beforeSave($insert);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'createdAt' => 'Erstellt am',
			'createdFrom' => 'Erstellt von',
			'updatedAt' => 'Geändert am',
			'updatedFrom' => 'Geändert von',
		];
	}
}
