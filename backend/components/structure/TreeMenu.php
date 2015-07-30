<?php
namespace backend\components\structure;

use Yii;
use yii\base\Component;
use backend\models\structure\StructureRecord;

/**
 * Left Tree Menu
 */
class TreeMenu extends Component
{

    private $_tableRows = false;
	
	private $_hasChilds = false;


    /**
     * return menu items accordingly TreeMenuWidget widget format
     */
    public function getItems()
    {
        //$urlManager = Yii::$app->urlManager->createUrl();
        $menuItems = [
            'items' => $this->prepareRawTree()->prepareHasChilds()->getWidgetFormatedArray(),
            'options' => [
                'id' => 'left-menu',
                'class' => 'nav nav-sidebar sortable'
            ],
            'linkTemplate' => '<a href="{url}">{label_prefix}{label}{label_postfix}</a>',
            'submenuTemplate' => "\n<ul class='sortable nav nav-{level}-level'>\n{items}\n</ul>\n",
        ];
        //print_r($menuItems);
        return $menuItems;
    }
	
	protected function hasChilds($pid){
		$res = false;
		
		if(isset($this->_hasChilds[$pid])){
			$res = $this->_hasChilds[$pid];
		}
		
		return $res;
	}
	
	protected function prepareHasChilds(){
	
		if(!$this->_hasChilds){
	
			$strSQL = 'SELECT structure.id, pt.id AS pid FROM (SELECT id FROM structure WHERE is_dir = 1) AS pt LEFT JOIN structure ON pt.id = structure.parent_id';
			
			$rows = Yii::$app->db->createCommand($strSQL)->queryAll();
		
			foreach($rows as $row){
				$this->_hasChilds[$row['pid']] = $row['id']?true:false;
			}
		
		}
		
		return $this;
	}


    /**
     * @return array list of menu items for each levels
     */
    protected function prepareRawTree()
    {

        if (!$this->_tableRows)
        {

            $this->_tableRows = StructureRecord::find()->orderBy([
                'level' => SORT_ASC,
                'sort' => SORT_ASC
            ])->all();

        }

        return $this;

    }

    protected function getUrlArray(&$item){
        $res = $item->url;
		
		//by default link to update action
		if(empty($item->url)){
			$item->url = 'structure/update';
			$item->params = 'id='.$item->id;
		}

        if((string)$item->params!=''){
            parse_str($item->params,$arParams);
            $res = array_merge([$item->url], $arParams);
        }

        return $res;
    }

    protected function getWidgetFormatedArray()
    {
        $rawTable = &$this->_tableRows;
        $resArray = [$this->getHomeItem(['label' => 'Главная страница', 'url' => ['/dashboard']],0)];
        $itemById = []; //links to items
        if(count($rawTable)){
            $count_of_items = count($rawTable);
            $cur = 0;
            $old_parent_id = false;
            foreach($rawTable as $level => $item){
                    $cur++;
                    $url = $this->getUrlArray($item);
                    if($item->level == 1){
                        if($item->is_dir){
                            $itemById[$item->id] = $this->getDirItem(['label'=>$this->shortLabel($item->label), 'url'=>$url, 'level'=>2, 'color'=>$item->color],$item->id);
							if(!$this->hasChilds($item->id)){
								
								$itemById[$item->id]['items'] = [ $this->getAddNewItem(['label'=>'Добавить','url'=>['structure/create','id'=>$item->id]]) ];
							
							}
                        }else{
                            $itemById[$item->id] = $this->getSingleItem(['label'=>$this->shortLabel($item->label), 'url'=>$url, 'color'=>$item->color],$item->id);
                        }
                        $resArray[] = &$itemById[$item->id];
                    }else{
                        // level > 1, so have a parent with $item->parent_id
                        if($item->is_dir){
                            $itemById[$item->id] = $this->getDirItem(['label'=>$this->shortLabel($item->label), 'url'=>$url,'level'=>($item->level+1), 'color'=>$item->color],$item->id);
							
							if(!$this->hasChilds($item->id)){
								$itemById[$item->id]['items'] = [ $this->getAddNewItem(['label'=>'Добавить','url'=>['structure/create','id'=>$item->id]]) ];
							}

						}else{
                            $itemById[$item->id] = $this->getSingleItem(['label'=>$this->shortLabel($item->label), 'url'=>$url, 'color'=>$item->color],$item->id);
                        }
                        // add link to parent
                        if(!$itemById[$item->parent_id]['items']){
                            $itemById[$item->parent_id]['items'] = [];
                        }
                        $itemById[$item->parent_id]['items'][] = &$itemById[$item->id];
                        if($old_parent_id!=$item->parent_id){
                            $itemById[$old_parent_id]['items'][] = $this->getAddNewItem(['label'=>'Добавить','url'=>['structure/create','id'=>$old_parent_id]]);
                        }
                        // last submenu branch
                        if($count_of_items == $cur){
						
                            $itemById[$item->parent_id]['items'][] = $this->getAddNewItem(['label'=>'Добавить','url'=>['structure/create','id'=>$item->parent_id]]);
                        }
                    }
                $old_parent_id = $item->parent_id;
            }
        }

        $resArray[] = $this->getAddNewItem(['label'=>'Добавить','url'=>'/structure/create']);
		

        return $resArray;
    }

    protected function shortLabel($lbl){

        if(Yii::$app->request->cookies->has('screen_width')){
            if((int)Yii::$app->request->cookies->getValue('screen_width',0)>1400){
                return $lbl;
            }
        }

        if(strlen($lbl)>28){

            $lbl = iconv('utf-8', 'windows-1251', $lbl);
            $lbl = substr($lbl, 0, 14).'...';
            $lbl = iconv('windows-1251', 'utf-8', $lbl);


        }
        return $lbl;
    }

    protected function getHomeItem($config,$node_id = false)
    {

        $res = $config;
        $res['label_prefix'] = '<i class="fa fa-home fa-fw"></i> ';
        if($node_id)
        {
            if(!isset($res['options']))
            {
                $res['options'] = [];
            }
            $res['options']['node-id'] = $node_id;
        }
        return $res;
    }

    protected function getAddNewItem($config)
    {

        $res = $config;
        $res['label_prefix'] = '<i class="fa fa-plus-square fa-fw"></i> ';

        if(!isset($res['options']))
        {
            $res['options'] = [];
        }
        $res['options']['class'] = 'ghost';

        return $res;
    }

    protected function getDirItem($config,$node_id = false)
    {
        $res = $config;
        $res['label_prefix'] = '<i class="multilevel fa fa-folder-o fa-fw"></i> ';
        $res['label_postfix'] = '<span class="fa arrow"></span><i class="item-settings fa fa-cog fa-lg fa-fw pull-right"></i>';
        if($node_id)
        {
            if(!isset($res['options']))
            {
                $res['options'] = [];
            }

            $color_class = '';
            if($res['color']!=''){
                $color_class = ' '.$res['color'];
            }

            $res['options']['node-id'] = $node_id;
			$res['options']['class'] = 'active is_dir'.$color_class;
        }
        return $res;
    }

    protected function getSingleItem($config,$node_id = false)
    {
        $res = $config;
        $res['label_prefix'] = '<i class="fa '.$this->getIcon($res).' fa-fw"></i> ';
        $res['label_postfix'] = ' <i class="item-settings fa fa-cog fa-lg fa-fw pull-right"></i>';
        if($node_id)
        {
            if(!isset($res['options']))
            {
                $res['options'] = [];
            }

            $color_class = '';
            if($res['color']!=''){
                $color_class = $res['color'];
            }

            $res['options']['node-id'] = $node_id;
            $res['options']['class'] = $color_class;
        }
        return $res;
    }

    protected function getIcon($res){
        $result = 'fa-cubes';

        if( strpos($res['url'][0],'article')!==false ){
            $result = 'fa-list';
        }elseif( strpos($res['url'][0],'structure')!==false ){
            $result = 'fa-file-text-o';
        }
        return $result;
    }


}
