<?php //print_r($managers);exit(); ?>

<?php 

use yii\widgets\LinkPager;
use yii\helpers\Url;

 ?>
<div>
	<h2 class="admin_tit">管理员列表</h2>
	<h3 class="admin_tit" style="color: #ff0000;"><?php
	if (Yii::$app->session->hasFlash('info')) {
		echo Yii::$app->session->getFlash('info');
	}
	?></h3>
	<div class="admin_handle">
		<a href="">首页</a> | <a href="<?=Url::to(['manage/reg']) ?>">添加管理员</a> | <a href="<?=Url::to(['manage/changeemail']) ?>">修改邮箱</a> | <a href="<?=Url::to(['manage/changepass']) ?>">修改密码</a>
	</div>
	<table class="admin_table">
		<tr>
			<td>ID</td>
			<td>user</td>
			<td>email</td>
			<td>logintime</td>
			<td>ip</td>
			<td>操作</td>
		</tr>
		<?php foreach ($managers as $k => $v): ?>
			<tr>
				<td><?=$v->id ?></td>
				<td><?=$v->username ?></td>
				<td><?=$v->email ?></td>
				<td><?=date('Y-m-d H:i:s',$v->logintime) ?></td>
				<td><?=long2ip($v->loginip) ?></td>
				<td><a href="<?=Url::to(['manage/delete', 'id'=>$v->id]) ?>">delete</a> | <a href="<?=Url::to(['manage/modify']) ?>">modify</a></td>
			</tr>
		<?php endforeach ?>
	</table>
	
	<div class="pager">
		<?=LinkPager::widget(['pagination'=>$pager]) ?>
<!-- 		<ul>
			<li><a href="">首页</a></li>
			<li><a href="">上一页</a></li>
			<li><a href="">2</a></li>
			<li><a href="">下一页</a></li>
			<li><a href="">尾页</a></li>
		</ul> -->
	</div>
</div>