<?php 

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


?>

<?php $form = ActiveForm::begin([
	'fieldConfig'=>[
		'template'=>'{input}{error}',
	],
]); ?>
	<div class="form-group">
    	<h2>后台登录</h2>
    	<?=$form->field($model, 'username')->hiddenInput() ?>
    	<?=$form->field($model, 'password')->passwordInput(["class"=>"form-control", "placeholder"=>"新密码"]) ?>
        <?=$form->field($model, 'repassword')->passwordInput(["class"=>"form-control", "placeholder"=>"确认密码"]) ?>
        <!-- username：<input class="form-control" type="text" name="username" > -->
        <!-- password：<input class="form-control" type="text" name="password" > -->
        <div>
        	<?=$form->field($model, 'rememberme')->checkbox(['id'=>'remember-me', 'template'=>'<div class="remember">{input}<label for="remember-me">记住我</label></div>']) ?>
        	<!-- <input type="checkbox"> 记住我 -->
            <a href="<?php echo Url::to(['public/login']); ?>" class="forgot">返回登录</a>
        </div>
        <?= Html::submitButton('找回密码', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>




























