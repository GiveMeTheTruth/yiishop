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
    	<h2 class="admin_tit">修改信息</h2>
    	<h3 class="admin_tit" style="color: #ff0000;"><?php if (Yii::$app->session->hasFlash('info')) {
    		echo Yii::$app->session->getFlash('info');
    	} ?></h3>
    	<?=$form->field($model, 'username')->textInput(["class"=>"form-control", "disabled"=>true]) ?>
    	
    	<?=$form->field($model, 'password')->passwordInput(["class"=>"form-control"]) ?>
        <?=$form->field($model, 'email')->textInput(["class"=>"form-control"]) ?>
        <!-- username：<input class="form-control" type="text" name="username" > -->
        <!-- password：<input class="form-control" type="text" name="password" > -->
        <?= Html::submitButton('修改', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>




























