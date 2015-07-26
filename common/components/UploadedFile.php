<?php
namespace common\components;

use Yii;
use common\helpers\Translit;

/**
 * Left Tree Menu
 */
class UploadedFile extends \yii\web\UploadedFile
{
	const DIR_UNDER_WEBROOT = 'uploads';

	protected $_preparedName = null;

	/*
	* Prepare
	*/
	public function getPreparedName($dirUnderWebroot = false)
	{
		
		if(!$this->_preparedName ){
		
			if(!$dirUnderWebroot){
				$dirUnderWebroot = self::DIR_UNDER_WEBROOT;
			}
			
			$translitedName = Translit::file($this->baseName);
			
			// by default
			$fileName = '/'.$dirUnderWebroot.'/' . $translitedName . '.' . $this->extension;
			
			$rand_dir = rand(1,100);
			
			$full_dir = Yii::getAlias('@webroot') . '/'.$dirUnderWebroot.'/' . $rand_dir . '/';
			if(!is_dir( $full_dir )){
				mkdir($full_dir);
			}
			
			if(is_dir($full_dir)){
					$fileName = '/'.$dirUnderWebroot.'/' . $rand_dir . '/' . $translitedName . '.' . $this->extension;
					
					//now find duplicates
					
					if(is_file( Yii::getAlias('@webroot') . $fileName )){
						$cnt = 1;
						$newFileName = '/'.$dirUnderWebroot.'/' . $rand_dir . '/' . $translitedName . '(' . $cnt . ').' . $this->extension;
						while(is_file(Yii::getAlias('@webroot') . $newFileName)){
							$cnt++;
							$newFileName = '/'.$dirUnderWebroot.'/' . $rand_dir . '/' . $translitedName . '(' . $cnt . ').' . $this->extension;
						}
						$fileName = $newFileName;
					}
					
			}
			
			$this->_preparedName = $fileName;
		}
		
		return $this->_preparedName;
	}
	
	/**
	* Return file path
	*/
	public function saveIt($deleteTempFile = true){
		$this->saveAs(Yii::getAlias('@webroot') . $this->getPreparedName(), $deleteTempFile);
	}
}