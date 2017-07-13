<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Here is your short link</h2>
                <p>
                    <?= Html::a(Yii::$app->urlManager->createAbsoluteUrl(array('link/go', 'link' => $model->cut)),
                        array('link/go', 'link' => $model->cut),
                        array('class' => 'btn btn-primary')
                    );?>
                </p>
            </div>
        </div>

    </div>
</div>
