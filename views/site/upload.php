<?php
use yii\widgets\ActiveForm;
echo Yii::$app->basePath."<br />"; // /Users/billcheng/Sites/basic
echo Yii::$app->request->BaseUrl."<br />"; // /~billcheng/basic/web(can't use this one)  
echo Yii::getAlias('@webroot')."<br />"; // /Users/billcheng/Sites/basic/web
echo Yii::getAlias('@web');// /~billcheng/basic/web
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>