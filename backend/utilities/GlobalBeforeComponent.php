<?php

namespace backend\utilities;

class GlobalBeforeComponent extends \yii\base\Component{
    
    public function init() {
        
        
       
        $this->setDefaultScreenSizeInfo();
        
        
        
        ///////////////
        parent::init();
    }
    
    protected function setDefaultScreenSizeInfo(){
        
        if( !\Yii::$app->request->cookies->has('screen_width') ){
            
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'screen_width',
                'value' => false,
            ]));

            
        }
        
    }
    
}