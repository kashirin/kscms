<?php
namespace backend\traits;

use backend\behaviors\AdminFormBehavior;
use yii\behaviors\TimestampBehavior;

trait AdminFormTrait{



	public static $STATUS_IS_ACTIVE = 1;
    public static $STATUS_IS_NOT_ACTIVE = 0;


	public function attributeLabels()
    {
		
		$ar = $this->getDescription();
		$res = [];
		foreach($ar as $key=>$item){
			if($key!='id'){
				$res[$key] = $item['label'];
			}
		}
	
        return $res;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            // automatic form generating with config
            'AdminForm' => AdminFormBehavior::className(),
        ];
    }

}