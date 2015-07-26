<?php

namespace frontend\widgets\snippet;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class SnippetAssetBundle extends AssetBundle
{
    public $sourcePath = '@app/widgets/snippet';
    /*public $css = [
        'metisMenu.min.css',
    ];*/
	public $js = [
        'snippet.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
