<?php

namespace app\controllers;


use app\models\EditForm;
use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class AccountController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        return $this->render('index',
            [
                'user' => $user
            ]
        );
    }

    public function actionEdit()
    {
        $user = Yii::$app->user->identity;

        $model = new EditForm();

        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'imageFile')) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $user = $model->edit($user->id, true);
            } else {
                $user = $model->edit($user->id);
            }
            if ($user) {
                return $this->redirect('/account/index');
            } else {
                Yii::$app->session->setFlash('error', 'Error edit name.');
                Yii::error('Error edit name');
                return $this->refresh();
            }
        }

        return $this->render('edit',
            [
                'model' => $model,
                'name' => $user->name
            ]
        );
    }
}