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
    	<h2>找回密码</h2>
    	<?=$form->field($model, 'username')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'email')->textInput(["class"=>"form-control"]) ?>
        <!-- username：<input class="form-control" type="text" name="username" > -->
        <!-- password：<input class="form-control" type="text" name="password" > -->
        <div>
        	
            <a href="<?php echo Url::to(['public/login']); ?>" class="forgot">返回登录</a>
        </div>
        <?= Html::submitButton('找回密码', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>




























