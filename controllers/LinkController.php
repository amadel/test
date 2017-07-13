<?php

namespace app\controllers;

use app\models\Link;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\VarDumper;
use app\models\SignupForm;

class LinkController extends Controller{

    /**
     * @return string
     */
    public function actionCreateShortLink(){

        if(Yii::$app->user->isGuest){
            $this->redirect('index');
        }

        $model = new Link();

        if(
            !empty(Yii::$app->request->post('Link') &&
            !empty(Yii::$app->request->post('Link')['original'])
        )){

            $model->original = Yii::$app->request->post('Link')['original'];

            if(
                !empty(Yii::$app->request->post('isExpire')) &&
                Yii::$app->request->post('isExpire') == 1
            ){
                $model->expire = date('Y-m-d H:i:s', strtotime('now +5 minutes'));
            }

            $model->cut = $model->generateRandomString();

            if($model->validate()){
                $model->save();
            }

            $this->redirect(array('view', 'id' => $model->id));
        }

        return $this->render('create-link', array('model' => $model));
    }

    public function actionView($id){

        if(empty($id)){
            throw new Exception('missing id param');
        }

        $model = Link::findOne(array('id' => $id));

        if(empty($model)){
            throw new Exception('not found');
        }

        if(
            $model->expire !== NULL &&
            $model->expire < date('Y-m-d H:i:s', strtotime('now'))
        ){
            $model->delete();
            Yii::$app->getSession()->setFlash('error', 'Link is expired');
            return $this->redirect('/link/create-short-link');
        }

        return $this->render('view-link', array('model' => $model));
    }

    public function actionGo($link){

        if(empty($link)){
            throw new Exception('missing id param');
        }

        $model = Link::find()->where('cut = :cut', ['cut'=>$link])->one();

        if(empty($model)){
            throw new Exception('missing link');
        }

        if(
            $model->expire !== NULL &&
            $model->expire < date('Y-m-d H:i:s', strtotime('now'))
        ){
            $model->delete();
            Yii::$app->getSession()->setFlash('error', 'Link is expired');
            return $this->redirect('/link/create-short-link');
        }

        $this->redirect($model->original);
    }
}
