<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'My Account';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome, <?= $user->name ?>!</h1>
        <p><?= $user->email ?></p>
        <?php if($user->image) {?>
            <p><img src="<?=Url::to('/images/') . $user->image?>" width="230" height="300"></p>
        <?php }?>

        <p class="lead">
            <a href="<?= Url::toRoute('account/edit')?>">Upload</a> |
            <a href="<?= Url::toRoute('site/logout')?>">Logout</a>
        </p>

    </div>

</div>