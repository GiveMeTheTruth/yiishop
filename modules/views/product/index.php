<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

//print_r($category);exit();

?>

<div>
    <h2 class="admin_tit">商品列表</h2>
    <h3 class="admin_tit" style="color: #ff0000;">
        <?php if(Yii::$app->session->hasFlash('info')){ echo Yii::$app->session->getFlash('info'); }  ?>
    </h3>

    <div class="admin_handle">
    <a href="<?=Url::to(['product/index']) ?>">首页</a> | <a href="<?=Url::to(['product/add']); ?>">添加商品</a>
    </div>
    <table class="admin_table">
        <tr>
            <td>ID</td>
            <td>分类名</td>
            <td>标题</td>
            <td>价格</td>
            <td>是否热卖</td>
            <td>是否促销</td>
            <td>数量</td>
            <td>操作</td>
        </tr>
        <?php foreach ($product as $i => $m): ?>
        <tr>
            <td><?=$m['productid']; ?></td>
            <td><?=$m['cateid']; ?></td>
            <td><?=$m['title']; ?></td>
            <td><?=$m['price']; ?></td>
            <td><?php $hot=['no', 'yes']; echo $hot[$m['ishot']]; ?></td>
            <td><?php $sale=['no', 'yes']; echo $sale[$m['issale']]; ?></td>
            <td><?=$m['num']; ?></td>
            <td><a href="<?=Url::to(['product/modify', 'id'=>$m['productid']]) ?>">modify</a> | <a href="<?=Url::to(['product/delete', 'id'=>$m['productid']]) ?>">delete</a></td>
        </tr>
        <?php endforeach ?>
    </table>
    <div class="pager">
        <?=LinkPager::widget(['pagination'=>$pager]) ?>
    </div>

</div>
















