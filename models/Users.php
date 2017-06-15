<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Users extends ActiveRecord
{
	
	public static function tableName()
	{
		return "users";
	}

	public function rules()
	{
		return [
			['username', 'required', 'message'=>'用户名不能为空！', 'on'=>['usersadd']],
			['password', 'required', 'message'=>'密码不能为空！', 'on'=>['usersadd']],
			['email', 'required', 'message'=>'邮箱不能为空！', 'on'=>['usersadd']],
			['email', 'email', 'message'=>'邮箱不能为空！', 'on'=>['usersadd']],
		];
	}

	public function usersadd($data)
	{
		$this->scenario = "usersadd";
		if ($this->load($data) && $this->validate()) {
			$this->createtime = time();
			$this->password = md5($this->password);
			if ($this->save(false)) {
				return true;
			}
			return false;
		}
		return false;
	}
}
























 ?>
