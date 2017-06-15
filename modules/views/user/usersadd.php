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
    	<?=$form->field($model, 'username')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'password')->passwordInput(["class"=>"form-control"]) ?>
        <!-- username：<input class="form-control" type="text" name="username" > -->
        <!-- password：<input class="form-control" type="text" name="password" > -->
        <?= Html::submitButton('登录', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>




























