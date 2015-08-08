<?php

namespace frontend\widgets;

use backend\models\event\EventRecord;


class EventsWidget extends \yii\base\Widget
{
    private $_items;

    private $_view;

    const CNT = 3;

    public $mode = 'top';

    protected function _initItems(){

    	if($this->mode == 'top'){

	    	$this->_items = EventRecord::find()
	    						->where(['active'=>EventRecord::$STATUS_IS_ACTIVE])
	    						->andWhere(['>','eventdate', time()])
	                            ->orderBy(['eventdate' => SORT_ASC])
	                            ->limit(self::CNT)
	                            ->all();
	        $this->_view = 'events';
        }elseif($this->mode == 'all'){
        	$this->_items = EventRecord::find()
	    						->where(['active'=>EventRecord::$STATUS_IS_ACTIVE])
	    						->andWhere(['>','eventdate', time()])
	                            ->orderBy(['eventdate' => SORT_ASC])
	                            ->all();
	        $this->_view = 'events_all';
        }

    }

    public function run()
    {
    	$this->_initItems();

        return $this->render($this->_view,['items' => $this->_items, 'widget'=>$this]);
    }
}