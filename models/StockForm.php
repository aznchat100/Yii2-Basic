<?php

namespace app\models;

use yii\base\Model;

class StockForm extends Model
{
    public $ticker;
    public $timeframe;
    public $name;
    public function rules()
    {
        return [
            [['ticker', 'timeframe'], 'required']
        ];
    }
}