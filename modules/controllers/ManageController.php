<?php 

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;
use app\modules\models\Admin;
use yii\data\Pagination;

/**
* 
*/
class ManageController extends Controller
{
	
	public function actionMailchangepass()
	{
		$time = Yii::$app->request->get("timestamp");
		$username = Yii::$app->request->get("username");
		$token = Yii::$app->request->get("token");
		$model = new Admin;
		$mytoken = $model->createToken($username, $time);

		if ($token != $mytoken) {
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		if (time() - $time > 300) {
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->changePass($post)) {
				Yii::$app->session->setFlash('info', '密码修改成功');
			}
		}

		$model->username = $username;
		return $this->render('mailchangepass', ['model'=>$model]);
	}

	public function actionManagers()
	{
		$model = Admin::find();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['manage'];

		$pager = new Pagination(['totalCount'=>$count, 'pageSize'=>$pageSize]);
		$managers = $model->offset($pager->offset)->limit($pager->limit)->all();

		return $this->render('managers', ['managers'=>$managers, 'pager'=>$pager]);
	}

	public function actionReg()
	{
		$model = new Admin;

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->reg($post)) {
				Yii::$app->session->setFlash('info', '添加成功');
			}else{
				Yii::$app->session->setFlash('info', '添加失败');
			}
		}
		$model->password = "";
		$model->repassword = "";
		return $this->render('reg', ['model'=>$model]);
	}

	public function actionDelete()
	{
		$id = Yii::$app->request->get("id");
		if (empty($id)) {
			$this->redirect(['manage/managers']);
		}
		$model = new Admin;
		if ($model->deleteAll('id = :id', [':id' => $id])) {
			Yii::$app->session->setFlash('info', '删除成功！');
			$this->redirect(['manage/managers']);
		}
	}

	public function actionChangeemail()
	{
		$model = Admin::find()->where('username = :user', [':user'=>Yii::$app->session['admin']['username']])->one();

		$model->password = '';

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->changeemail($post)) {
				Yii::$app->session->setFlash('info', '修改成功！');
			}
		}

		return $this->render('changeemail', ['model'=>$model]);
	}

	public function actionChangepass()
	{
		$model = Admin::find()->where('username = :user', [':user'=>Yii::$app->session['admin']['username']])->one();

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->changepass($post)) {
				Yii::$app->session->setFlash('info', '修改成功！');
			}
		}

		$model->password = "";
		$model->repassword = "";
		return $this->render('changepass', ['model'=>$model]);
	}




}






























 ?>