<?php

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;
use app\models\Category;
use yii\data\Pagination;

class CategoryController extends Controller
{

    public function actionIndex()
    {
        $model = new Category();
        // $count = $model->count();
        // $pageSize = Yii::$app->params['pageSize']['manage'];

        //$pager = new Pagination(['totalCount'=>$count, 'pageSize'=>$pageSize]);
        //$category = $model->offset($pager->offset)->limit($pager->limit)->all();
        $category = $model->getTreelist();
        return $this->render('index', ['category'=>$category]);
    }

	public function actionAdd()
    {
        $model = new Category();
        // $listData = $model->getOptions();
        //$cates = $model->getData();
        //$tree = $model->getTree($cates);
        //$pre = $model->setPrefix($tree);
        // print_r($pre);exit();
        $listData = $model->getOptions();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->add($post)){
                Yii::$app->session->setFlash('info', '添加成功！');
            }
        }

		return $this->render('add', ['listData'=>$listData, 'model'=>$model]);
	}

	public function actionModify()
	{
        $cateid = Yii::$app->request->get("cateid");
        $model = Category::find()->where('cateid = :id', [':id'=>$cateid])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->modify($cateid, $post)) {
                Yii::$app->session->setFlash('info', '更新成功！');
                return $this->redirect(['category/index']);
            }
        }

        $listData = $model->getOptions();
		return $this->render('add', ['model'=>$model, 'listData'=>$listData]);
	}

    public function actionDelete()
    {
        try{
            $cateid = Yii::$app->request->get("cateid");
            if (empty($cateid)) {
                throw new \Exception();
            }
            $data = Category::find()->where('parentid = :id', [':id'=>$cateid])->one();
            if ($data) {
                throw new \Exception("分类下有子类，不能删除");            
            }
            if (!Category::deleteAll('cateid = :id', [':id'=>$cateid])) {
                throw new \Exception("删除失败！");
                
            }
        }catch(\Exception $e){
            Yii::$app->session->setFlash('info', '删除失败！');
        }
        return $this->redirect(['category/index']);
    }





}

















?>
