<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Sergey Kashirin
 * @since 2.0
 */
class TinyMceAsset extends AssetBundle
{
    public $sourcePath = '@webroot/js/tinymce';
	
	public $jsOptions =['position'=>\yii\web\View::POS_HEAD ];
	
	public $publishOptions = [
		'forceCopy' => true,
	];

	public $js = [
        'tinymce.min.js',
    ];
}
