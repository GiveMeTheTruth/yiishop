<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

//print_r($category);exit();

?>

<div>
    <h2 class="admin_tit">分类列表</h2>
    <h3 class="admin_tit" style="color: #ff0000;">
        <?php if(Yii::$app->session->hasFlash('info')){ echo Yii::$app->session->getFlash('info'); }  ?>
    </h3>

    <div class="admin_handle">
    <a href="">首页</a> | <a href="<?=Url::to(['category/add']); ?>">添加分类</a>
    </div>
    <table class="admin_table">
        <tr>
            <td>ID</td>
            <td>分类名</td>
            <td>上级分类</td>
            <td>操作</td>
        </tr>
        <?php foreach ($category as $i => $m): ?>
        <tr>
            <td><?=$m['cateid']; ?></td>
            <td><?=$m['title']; ?></td>
            <td><?=$m['parentid']; ?></td>
            <td><a href="<?=Url::to(['category/modify', 'cateid'=>$m['cateid']]) ?>">modify</a> | <a href="<?=Url::to(['category/delete', 'cateid'=>$m['cateid']]) ?>">delete</a></td>
        </tr>
        <?php endforeach ?>
    </table>
    <div class="pager">
        <?//=LinkPager::widget(['pagination'=>$pager]) ?>
    </div>

</div>
















