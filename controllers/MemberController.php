<?php 

namespace app\controllers;

use yii\web\Controller;

/**
* 
*/
class MemberController extends Controller
{
	
	public function actionAuth()
	{
		return $this->render('auth');
	}
}
 ?>