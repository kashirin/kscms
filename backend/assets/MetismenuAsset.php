<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class MetismenuAsset extends AssetBundle
{
    public $sourcePath = '@vendor/onokumus/metismenu/dist';
    public $css = [
        'metisMenu.min.css',
    ];
	public $js = [
        'metisMenu.min.js',
    ];
}
