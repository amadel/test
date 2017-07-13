<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Statistic extends ActiveRecord{

    public $id;
    public $goTime;
    public $country;
    public $city;
    public $userAgent;

}
