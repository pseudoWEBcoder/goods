<?php

namespace frontend\controllers;


use common\models\UploadForm;
use yii\web\UploadedFile;

class ImportController extends \yii\web\Controller
{
    public function actionUpload()
    {
        $model = new UploadForm();
        if ($model->load(\Yii::$app->request->post()))
        if (\Yii::$app->request->isPost) {
            $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');
            if ($model->upload()) {
                $added = $model->exec();
                return $this->render('result', ['model' => $model]);
            }
        }

        return $this->render('file_form', ['model' => $model]);
    }
}


