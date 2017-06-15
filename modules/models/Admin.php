<?php 

namespace app\modules\models;


use Yii;
use yii\db\ActiveRecord;

/**
* admin表类
*/
class Admin extends ActiveRecord
{
	public $rememberme = false;
	public $repassword;
	
	public static function tableName()
	{
		return "admin";
	}

	public function attributeLabels()
	{
		return [
			'username'=>'管理员账号',
			'email'=>'邮箱',
			'password'=>'密码',
			'repassword'=>'确认密码',
		];
	}

	public function rules()
	{
		return [
			['username', 'required', 'message'=>'账号不能为空！', 'on'=>['login', 'seekpass', 'changepass', 'adminadd', 'changeemail']],
			['password', 'required', 'message'=>'密码不能为空！', 'on'=>['login', 'changepass', 'adminadd', 'changeemail']],
			['repassword', 'required', 'message'=>'密码不能为空！', 'on'=>['changepass']],
			['repassword','compare', 'compareAttribute'=>'password', 'message'=>'密码不一致', 'on'=>['changepass', 'adminadd']],
			['rememberme', 'boolean', 'on'=>'login'],
			['password', 'validatePass', 'on'=>['login', 'changeemail']],
			['email', 'required', 'message'=>'邮件不能为空！', 'on'=>['seekpass', 'adminadd', 'changeemail']],
			['email', 'email', 'message'=>'邮件有误！', 'on'=>['seekpass', 'adminadd', 'changeemail']],
			['email', 'unique', 'message'=>'邮件已注册！', 'on'=>['adminadd', 'changeemail']],
			['username', 'unique', 'message'=>'用户名已注册！', 'on'=>['adminadd']],
			['email', 'validateEmail', 'on'=>'seekpass'],
		];
	}

	public function validatePass()
	{
		if (!$this->hasErrors()) {
			$data = self::find()->where('username = :user and password = :pass', [":user"=>$this->username, ":pass"=>md5($this->password)])->one();
			if (is_null($data)) {
				$this->addError("password", "用户名或者密码错误！");
			}
		}
	}

	public function validateEmail()
	{
		if (!$this->hasErrors()) {
			$data = self::find()->where('username = :user and email = :email', [":user"=>$this->username, ":email"=>$this->email])->one();
			if (is_null($data)) {
				$this->addError("email", "管理员与邮箱不符！");
			}
		}
	}

	public function login($data)
	{
		$this->scenario = "login";
		if ($this->load($data) && $this->validate()) {
			$lifetime = $this->rememberme ? 24*3600 : 0;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['admin'] = [
				'username' => $this->username,
				'islogin' => 1,
			];
			$this->updateAll(['logintime'=>time(), 'loginip'=>ip2long(Yii::$app->request->userIp)], 'username=:user', [':user'=>$this->username]);
			return (bool)$session['admin']['islogin'];
		}
		return false;
	}

	public function seekPass($data)
	{
		$this->scenario = "seekpass";
		if ($this->load($data) && $this->validate()) {
			$time = time();
			$token = $this->createToken($data['Admin']['username'], $time);
			$mailer = Yii::$app->mailer->compose('seekpass', ['username'=>$data['Admin']['username'], 'time'=>$time, 'token'=>$token]);
			$mailer->setFrom("253395542@qq.com");
			$mailer->setTo($data['Admin']['email']);
			$mailer->setSubject("shop-找回密码");
			if ($mailer->send()) {
				return true;
			}
		}
		return false;
	}

	public function createToken($username, $time)
	{
		return md5(md5($username).base64_encode(Yii::$app->request->userIp).md5($time));
	}

	public function changePass($data)
	{
		$this->scenario = "changepass";
		if ($this->load($data) && $this->validate()) {
			return $this->updateAll(['password'=>md5($this->password)], 'username = :user', [':user'=>$this->username]);
		}
		return false;
	}

	public function reg($data)
	{
		$this->scenario = "adminadd";
		// $data['Admin']['password'] = md5($data['Admin']['password']);
		// $data['Admin']['repassword'] = md5($data['Admin']['repassword']);
		if ($this->load($data) && $this->validate()) {
			$this->password = md5($this->password);
			if ($this->save(false)) {
				return true;
			}
			return false;
		}
		return false;
	}

	public function changeEmail($data)
	{
		$this->scenario = "changeemail";
		if ($this->load($data) && $this->validate()) {
			return $this->updateAll(['email'=>$this->email], 'username = :user', [':user'=>$this->username]);
		}
		return false;
	}

}





































 ?>