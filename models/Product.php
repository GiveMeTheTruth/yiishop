<?php 

namespace app\models;

use yii\db\ActiveRecord;

/**
* 
*/
class Product extends ActiveRecord
{
	
	public static function tableName()
	{
		return "product";
	}

	public function rules()
	{
		return [
			['title', 'required', 'message'=>'标题必填！'],
			['cateid', 'required', 'message'=>'标题必填！'],
			['desc', 'required', 'message'=>'标题必填！'],
			['price', 'required', 'message'=>'标题必填！'],
			['ishot', 'required', 'message'=>'标题必填！'],
			['issale', 'required', 'message'=>'标题必填！'],
			['saleprice', 'required', 'message'=>'标题必填！'],
			['ison', 'required', 'message'=>'标题必填！'],
		];
	}

	public function attributeLabels()
	{
		return [
			'cateid'=>'分类',
			'title'=>'标题',
			'desc'=>'描述',
			'price'=>'价格',
			'ishot'=>'是否热卖',
			'issale'=>'是否促销',
			'saleprice'=>'促销价格',
			'ison'=>'是否上架',
		];
	}

	public function add($data)
	{
		$this->createtime = time();
		if ($this->load($data) && $this->save()) {
			return true;
		}
		return false;
	}
}


 ?>