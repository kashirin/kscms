<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}
