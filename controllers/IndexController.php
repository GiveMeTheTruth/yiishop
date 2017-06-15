<?php 

namespace app\controllers;

use yii\web\Controller;
use app\models\Admin;

class IndexController extends Controller
{
	public function actionIndex()
	{
		$model = new Admin;
		$data = $model->find()->one();
		$this->layout = false;
		return $this->render('index', ['data'=>$data]);
	}
}

 ?>