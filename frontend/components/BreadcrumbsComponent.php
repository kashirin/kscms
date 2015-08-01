<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use backend\models\structure\StructureRecord;
use backend\models\article\ArticleRecord;



/**
 * Breadcrumbs generator
 */
class BreadcrumbsComponent extends Component
{
	const MAIN_PAGE_TITLE = 'Главная';

	protected function _arrayInit(){
		return [
			[
				'label' => self::MAIN_PAGE_TITLE,
				'url'   => '/'
			]
		];
	}

	public function getBreadcrumbs($model){
		if($model instanceof StructureRecord){
			return $this->_getArrayForPage($model);
		}elseif($model instanceof ArticleRecord){
			return $this->_getArrayForArticle($model);
		}else{
			//throw new \Exception("Breadcrumbs error, item model must be StructureRecord or ArticleRecord instance");
			return [];
		}
	}

	protected function _getArrayForPage(StructureRecord $modelStructure){
		$arBreadcrumbs = $this->_arrayInit();

		$menuAsTable = Yii::$app->mainMenu->getMenuAsTable();

		if(!isset( $menuAsTable[$modelStructure->seourl] )){

			$arBreadcrumbs[] = [
				'label' => $modelStructure->label,
				'url'   => false
			];

		}else{

			if(!$menuAsTable[$modelStructure->seourl]['parent_url']){

				$arBreadcrumbs[] = [
					'label' => $modelStructure->label,
					'url'   => false
				];
			}else{

				$arBreadcrumbs[] = [
					'label' => $menuAsTable[ $menuAsTable[$modelStructure->seourl]['parent_url'] ]['label'],
					'url'   => $menuAsTable[ $menuAsTable[$modelStructure->seourl]['parent_url'] ]['url']
				];

				$arBreadcrumbs[] = [
					'label' => $modelStructure->label,
					'url'   => false
				];
			}

		}


		return $arBreadcrumbs;
	}

	protected function _getArrayForArticle(ArticleRecord $modelArticle){
		$arBreadcrumbs = $this->_arrayInit();
		// assume that two-level menu is actual structure, only this case!
		$firstLevelStructure = StructureRecord::find()->where(['id' => $modelArticle->parent_id])->one();
		if(!$firstLevelStructure){
			throw new \Exception("Breadcrumbs error, article must have parent structure item");
		}

		$parent_id = (int) $firstLevelStructure->parent_id;

		if(!$parent_id){

			$arBreadcrumbs[] = [
				'label' => $firstLevelStructure->label,
				'url'   => '/' . $firstLevelStructure->seourl
			];

			
		}else{

			$secondLevelStructure = StructureRecord::find()
													->where(['id' => $firstLevelStructure->parent_id])
													->one();
			if(!$secondLevelStructure){
				throw new \Exception("Breadcrumbs error, no structure item with id = ".$firstLevelStructure->parent_id);
			}

			$arBreadcrumbs[] = [
				'label' => $secondLevelStructure->label,
				'url'   => '/' . $secondLevelStructure->seourl
			];

			$arBreadcrumbs[] = [
				'label' => $firstLevelStructure->label,
				'url'   => '/' . $firstLevelStructure->seourl
			];

		}

		$arBreadcrumbs[] = [
				'label' => $modelArticle->name,
				'url'   => false
		];

		return $arBreadcrumbs;

	}
}