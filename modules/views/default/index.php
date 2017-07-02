<?php 

use yii\helpers\Url;
 ?>

<div class="admin-default-index">
    <h1>后台管理</h1>
    <table class="index_table" style="width: 80%; margin: auto;">
        <tr>
            <td><a href="">首页信息</a></td>
            <td><a href="<?=Url::to(['user/index']); ?>">用户管理</a></td>
            <td><a href="<?=Url::to(['manage/managers']);?>">管理员</a></td>
            <td><a href="<?=Url::to(['category/index']);?>">分类管理</a></td>
        </tr>
        <tr>
            <td><a href="<?=Url::to(['product/index']); ?>">商品管理</a></td>
            <td>用户</td>
            <td>管理员</td>
        </tr>
    </table>
</div>
