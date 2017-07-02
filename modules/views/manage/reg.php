<?php 

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
	'fieldConfig'=>[
		'template'=>'{label}{input}{error}',
	],
]); ?>
	<div class="form-group">
    	<h2 class="admin_tit">添加管理员</h2>
    	<h3 class="admin_tit" style="color: #ff0000;"><?php if (Yii::$app->session->hasFlash('info')) {
    		echo Yii::$app->session->getFlash('info');
    	} ?></h3>
    	<?=$form->field($model, 'username')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'email')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'password')->passwordInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'repassword')->passwordInput(["class"=>"form-control"]) ?>
        <!-- username：<input class="form-control" type="text" name="username" > -->
        <!-- password：<input class="form-control" type="text" name="password" > -->
        <div>
        	<!-- <?=$form->field($model, 'rememberme')->checkbox(['id'=>'remember-me', 'template'=>'<div class="remember">{input}<label for="remember-me">记住我</label></div>']) ?> -->
        	<!-- <input type="checkbox"> 记住我 -->
            <!-- <a href="<?php echo Url::to(['public/seekpassword']); ?>" class="forgot">忘记密码</a> -->
        </div>
        <?= Html::submitButton('添加', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>


