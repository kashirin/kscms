<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class BootstrapJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';

	public $js = [
        'js/bootstrap.js',
    ];
}
