<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php
    $form = ActiveForm::begin([
        'fieldConfig' =>[
            'template' => '{label}{input}{error}',
        ],
        'options' =>[
            'class'=>'',
        ],

    ]);
?>
<div class="form-group">
    <h2 class="admin_tit">添加分类</h2>
    <h3 class="admin_tit" style="color: #ff0000;"><?php if(Yii::$app->session->hasFlash('info')){ echo Yii::$app->session->getFlash('info');} ?></h3>
    <div calss="admin_handle">
        <a href="<?=Url::to(['category/index']) ?>">首页</a>
    </div>
    <?=$form->field($model, 'parentid')->dropDownList($listData); ?>
    <?=$form->field($model, 'title')->textInput(['class'=>"form-control"]) ?>
    <?=Html::submitButton('添加', ["class"=>"btn btn-primary"]) ?>
</div>


<?php
    $form = ActiveForm::end();
?>
