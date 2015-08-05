<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use backend\models\structure\StructureRecord;
use backend\models\article\ArticleRecord;



class SitemapComponent extends Component
{
	
	public function getArticles(){



		$articles = ArticleRecord::find()
			    ->select('article.seourl as url, article.name, structure.seourl as s_url, structure.label')
			    ->leftJoin('structure', '`structure`.`id` = `article`.`parent_id`')
			    ->where(['article.active' => ArticleRecord::STATUS_IS_ACTIVE])
			    ->with('structure')
			    ->asArray()
			    ->all();

		$menu = Yii::$app->mainMenu->getMainMenu();

		$arts = [];
		foreach($articles as $art){
			if(!isset($arts[ $art['s_url'] ])){
				$arts[ $art['s_url'] ] = [];
			}
			$arts[ $art['s_url'] ][] = $art;
		}

		

		foreach($menu as $k=>$first_level){
			if(isset($arts[ $first_level['url'] ])){
				$menu[$k]['articles'] = $arts[ $first_level['url'] ];
			}
			$cnt = 0;
			if($first_level['children']){
				foreach($first_level['children'] as $l=>$second_level){
					if(isset($arts[ $second_level['url'] ])){
						$menu[$k]['children'][$l]['articles'] = $arts[ $second_level['url'] ];
						$cnt++;
					}
				}
			}

			if(!$cnt){
				unset($menu[$k]);
			}

		}

		return $menu;

	}

	public function getPages(){
		return [
			['url'=>'about', 'name'=>'О сайте']
		];
	}
	
}