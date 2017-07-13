<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

class Link extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['cut', 'unique', 'targetAttribute' => ['cut'], 'message' => 'Short link must be unique.'],
            ['original', 'trim'],
            ['original', 'required'],
            ['original', 'string', 'max' => 255],
        ];
    }

    public function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
