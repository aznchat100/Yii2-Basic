<?php
use yii\widgets\ActiveForm;
//echo Yii::$app->basePath; /Library/Webserver/Document/basic
//echo Yii::$app->request->BaseUrl; /basic/web(can'y use this one)  
//echo Yii::getAlias('@webroot'); /Library/Webserver/Document/basic
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>