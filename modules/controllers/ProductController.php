<?php 

namespace app\modules\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Product;
use app\models\Category;
use Yii;

/**
* 
*/
class ProductController extends Controller
{
	
	public function actionIndex()
	{
		$model = Product::find();
		$cate = new Category();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['product'];
		$pager = new Pagination(['totalCount'=>$count, 'pageSize'=>$pageSize]);
		$product = $model->offset($pager->offset)->limit($pager->limit)->all();
		// print_r($product);exit();
		// if (count($product)) {
		// 	foreach ($product as $k => $v) {
		// 		$product[$k]['cateida'] = $cate->getCateById($v['cateid']);
		// 	}
		// }
		// print_r($cate->getCateById($product[1]['cateid']));exit();

		return $this->render('index', ['product'=>$product, 'pager'=>$pager]);
	}

	public function actionAdd()
	{
		$model = new Product();
		$cate = new Category();
		$list = $cate->getOptions();
		// print_r($list);exit();
		unset($list[0]);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			// $pics = $this->upload();
			// if (!$pics) {
			// 	$model->addError('cover', '封面不能为空！'); 
			// }
			// print_r($post);exit();
			if ($model->add($post)) {
				Yii::$app->session->setFlash('info','添加成功！');
				return $this->redirect(['product/index']);
			}else{
				Yii::$app->session->setFlash('info', '添加失败！');
			}

		}

		return $this->render('add', ['cates'=>$list, 'model'=>$model]);

    }

    public function actionModify()
    {
        $cate = new Category;
        $list = $cate->getOptions();
        array_shift($list);
        //print_r($list);exit();

        $productid = Yii::$app->request->get('id');

        $model = Product::find()->where('productid = :id', [':id'=>$productid])->one();

        return $this->render('add', ['model'=>$model, 'cates'=>$list]);
    }

	public function actionUpload()
	{

	}
}
























 ?>
