<?php
/**
 * Created by PhpStorm.
 * User: ch
 * Date: 18.09.2018
 * Time: 08:55
 */

namespace app\components;


use Hashids\Hashids;

class HashHelper
{

	private static $_alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function encode($value) {

		/** @var Hashids $hashids */
		$hashids = new Hashids(\Yii::$app->params['hashId']['salt'], \Yii::$app->params['hashId']['length'], self::$_alphabet);

		return $hashids->encode($value);
	}

	/**
	 * @param $value
	 * @param bool $warning
	 *
	 * @return bool
	 */
	public static function decode($value, $warning = true) {

		/** @var Hashids $hashids */
		$hashids = new Hashids(\Yii::$app->params['hashId']['salt'], \Yii::$app->params['hashId']['length'], self::$_alphabet);

		$id = $hashids->decode($value);

		if(isset($id[0]) && count($id) == 1) {
			return $id[0];
		}elseif(count($id) > 1){
			return $id;
		}else{
			if($warning){
				\Yii::warning('Keine gültige HashID: '.$value, 'Hashids');
			}
			return false;
		}
	}

}
