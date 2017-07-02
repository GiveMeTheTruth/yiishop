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
    	<h2 class="admin_tit">添加商品</h2>
    	<h3 class="admin_tit" style="color: #ff0000;"><?php if (Yii::$app->session->hasFlash('info')) {
    		echo Yii::$app->session->getFlash('info');
    	} ?></h3>
    	<?=$form->field($model, 'cateid')->dropDownList($cates, ['id'=>'cateid']) ?>
    	<?=$form->field($model, 'title')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'desc')->textarea(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'price')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'ishot')->radiolist([0=>"不热卖", 1=>"热卖"]) ?>
    	<?=$form->field($model, 'issale')->radiolist([0=>"不促销", 1=>"促销"]) ?>
    	<?=$form->field($model, 'saleprice')->textInput(["class"=>"form-control"]) ?>
    	<?=$form->field($model, 'ison')->radiolist([0=>"下架", 1=>"上架"]) ?>
    	<?//=$form->field($model, 'pics[]')->fileInput() ?>
        <?= Html::submitButton('添加', ["class"=>"btn btn-primary"]) ?>
        <!-- <input id="sub" class="btn btn-primary" type="button" value="submit" > -->
    
</div>
<?php $form = ActiveForm::end(); ?>


