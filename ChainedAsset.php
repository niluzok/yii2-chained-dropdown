<?php

namespace niluzok\yii2chained;

use yii\web\AssetBundle;

class ChainedAsset extends AssetBundle
{
    public $sourcePath = '@bower/chained';

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
        {
            parent::init();
            
            $this->js[] = YII_DEBUG ? 'jquery.chained.js' : 'jquery.chained.min.js';
        }
}
