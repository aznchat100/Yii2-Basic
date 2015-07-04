<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            ['imageFile', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
        //['primaryImage', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
    }

    public function upload()
    {
        if ($this->validate()) {
            //yii::setAlias('@path1', 'localhost/basic/');
            $this->imageFile->saveAs(\Yii::$app->basePath.'/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}

//echo Yii::$app->basePath; /Library/Webserver/Document/basic
//echo Yii::$app->request->BaseUrl; /basic/web(can'y use this one)  
//echo Yii::getAlias('@webroot'); /Library/Webserver/Document/basic
