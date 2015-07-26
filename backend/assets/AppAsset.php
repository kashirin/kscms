<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
		'js/admin.js'
    ];
    public $depends = [
		'backend\assets\TinyMceAsset',
		'yii\bootstrap\BootstrapAsset',
		
        'yii\web\YiiAsset',
		'yii\jui\JuiAsset',
		//'backend\assets\Bootstrap3DialogAsset',
		'backend\assets\MetismenuAsset',
		'backend\assets\FontAwesomeAsset',
        'backend\assets\BootstrapJsAsset',

    ];
}
