<?php 

namespace app\modules\controllers;

use Yii;
use yii\web\Controller;
use app\modules\models\Admin;

/**
* 
*/	
class PublicController extends Controller
{
	// public $layout = false;
	
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionLogin()
	{
		$model = new Admin;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->login($post)) {
				$this->redirect(['default/index']);
				Yii::$app->end();
			}
		}
		return $this->render('login', ['model'=>$model]);
	}

	public function actionLogout()
	{
		Yii::$app->session->removeAll();
		if (!isset(Yii::$app->session['admin']['islogin'])) {
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		$this->goback();
	}

	//忘记密码
	public function actionSeekpassword() 
	{
		$model = new Admin;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$model -> seekPass($post);
		}
		return $this->render('seekpassword', ['model'=>$model]);
	}
}





















 ?>