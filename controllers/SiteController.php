<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\IndexForm;
use app\models\Link;
use app\models\User;

class SiteController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $model = new IndexForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($link = $model->generateLink()) {
                    if (User::findByEmail($link->email)) {
                        $url = Yii::$app->urlManager->createAbsoluteUrl(
                            [
                                '/site/login',
                                'token' => $link->token
                            ]
                        );
                    } else {
                        $url = Yii::$app->urlManager->createAbsoluteUrl(
                            [
                                '/site/reg',
                                'token' => $link->token
                            ]
                        );
                    }
                    if ($model->sendMail($url, $link->email)) {
                        Yii::$app->session->setFlash('warning', 'Check your email');
                        return $this->redirect('/site/index');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error generate link.');
                    Yii::error('Error generate link');
                    return $this->refresh();
                }
            }

            return $this->render('index', [
                'model' => $model,
            ]);
        }
        return $this->redirect('/account/index');
    }

    public function actionReg($token)
    {
        if (Yii::$app->user->isGuest && ($link = Link::findByToken($token))) {
            $email = $link->email;
            $model = new RegForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($user = $model->reg()) {
                    if (Yii::$app->getUser()->login($user)) {
                        Link::deleteLinksByToken($token);
                        return $this->redirect('/account/index');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error sign up.');
                    Yii::error('Error sign up');
                    return $this->refresh();
                }
            }

            return $this->render('reg',
                [
                    'model' => $model,
                    'email' => $email,
                ]
            );
        }
        return $this->redirect('/site/index');
    }

    public function actionLogin($token)
    {
        if (Yii::$app->user->isGuest && ($link = Link::findByToken($token))) {
            $email = $link->email;
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                Link::deleteLinksByToken($token);
                return $this->redirect('/account/index');
            }
            return $this->render('login',
                [
                    'model' => $model,
                    'email' => $email,
                ]
            );
        }
        return $this->redirect('/site/index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/site/index');
    }
}
