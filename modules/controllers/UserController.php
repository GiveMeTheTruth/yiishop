<?php 

namespace app\modules\controllers;

use yii\web\Controller;
use app\models\Users;

/**
* 
*/
class UserController extends Controller
{
	
	public function actionIndex()
	{
		$model = Users::findAll();
		
		return $this->render('index', ['model'=>$model]);
	}

	public function actionUsersadd()
	{
		$model = new Users;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->usersadd($post)) {
				Yii::$app->session->setFlash('info', '添加成功！');
			}
		}
		$model->password = '';
		return $this->render('usersadd', ['model'=>$model]);
	}


















}






























 ?>