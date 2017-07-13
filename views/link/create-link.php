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
                <h2>Enter url that you want to cut </h2>
                <div style="font-weight:bold;font-size: 14pt;color:#ff8482;">
                    <?= Yii::$app->session->getFlash('error'); ?>
                </div>
                <p>
                    <?php $form = ActiveForm::begin(['id' => 'form-create-link']); ?>
                        <?= $form->field($model, 'original')->textInput(['autofocus' => true]) ?>
                        <div class="form-group">
                            <?= Html::submitButton('create short link', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                        <?= Html::checkbox('isExpire',!empty($model->expire), array('label' => 'Expired'));
                        ?>
                    <?php ActiveForm::end(); ?>
                </p>

            </div>
        </div>

    </div>
</div>
