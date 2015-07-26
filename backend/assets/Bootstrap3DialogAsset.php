<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class Bootstrap3DialogAsset extends AssetBundle
{
    public $sourcePath = '@vendor/cross-solution/bootstrap3-dialog/dist';
    public $css = [
        'css/bootstrap-dialog.min.css',
    ];
	public $js = [
        'js/bootstrap-dialog.min.js',
    ];
}
