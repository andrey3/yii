<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\IndexForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <?php
            if (Yii::$app->session->hasFlash('warning')) {
                echo '<div class="flash-warning">' . Yii::$app->session->getFlash('warning') . "</div>\n";
            }
        ?>

        <p class="lead">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-4\"></div>\n{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'email') ?>

            <div class="form-group">
                <div class="col-lg-12">
                    <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </p>

    </div>

</div>
