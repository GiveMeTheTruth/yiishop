<?php

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;

class CategoryController extends Controller
{
	public function actionList()
	{
		return $this->render('list');
	}

	public function actionAdd()
	{
		return $this->render('add');
	}

	public function actionedit()
	{
		return $this->render('edit');
	}





}



?>
