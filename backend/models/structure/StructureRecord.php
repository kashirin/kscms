<?php
namespace backend\models\structure;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Structure model
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $params
 * @property string $info
 * @property integer $sort
 * @property integer $level
 * @property integer $collapsed
 * @property integer $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class StructureRecord extends ActiveRecord
{
    const STATUS_COLLAPSED = 1;
    const STATUS_NOT_COLLAPSED = 0;
	
	const STATUS_IS_DIR = 1;
    const STATUS_IS_NOT_DIR = 0;
	
	const ITEM_TYPE_PAGE = 'page'; // single page
	const ITEM_TYPE_ARTICLES = 'articles'; // build-in articles
	const ITEM_TYPE_URL = 'url'; //arbitrary url for any module access

	const STATUS_IS_ACTIVE = 1;
    const STATUS_IS_NOT_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%structure}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
	
	private $_purpose;
	
	public function setPurpose($val){
		$this->_purpose = $val;
	}
	
	public function getPurpose(){
		return $this->_purpose;
	}
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
		
			//check unique seourl
			
			if($insert){
				$struct = self::find()->where(['seourl' => $this->seourl])->one();
			}else{
				$struct = self::find()->where(['seourl' => $this->seourl])->andWhere('id != '.$this->id)->one();
			}
			
			
			$base_seourl = $this->seourl;
			if($struct){
				$cnt = 1;
				$new_seourl = $base_seourl . '-(' . $cnt.')';
				while(self::find()->where(['seourl' => $new_seourl])->one()){
					$cnt++;
					$new_seourl = $base_seourl . '-(' . $cnt.')';
				}
				$this->seourl = $new_seourl;
			}
			
			
			if($insert){
				// calculate sort prop

				if((int)$this->parent_id!=0){
					$command = static::getDb()->createCommand("SELECT MAX(sort) as srt from ".$this->tableName()." where parent_id = ".$this->parent_id)->queryOne();
				}else{
					$command = static::getDb()->createCommand("SELECT MAX(sort) as srt from ".$this->tableName()."")->queryOne();
				}

				
				$this->sort = $command['srt'] + 5;
				// calculate level
				$this->level = 1;
				if((int)$this->parent_id!=0){
					//start searching
					$pid = (int)$this->parent_id;
					
					$cnt = 0;
					while($command = static::getDb()->createCommand("SELECT * from ".$this->tableName()." WHERE id=:pid")
					->bindValue(':pid', $pid)->queryOne()){
						$this->level++;
						$cnt++;
						$pid = $command['parent_id'];
						if($cnt>10){
							$this->level = 1;
							break;
						}
					}
				}
				
				
				return true;
			}
			
			return true;
		} else {
			return false;
		}
	}
	
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		if($this->purpose == self::ITEM_TYPE_PAGE){
			
			$this->url = Url::to('/structure/update');
			$this->params = 'id='.$this->id;
			$this->updateAttributes(['url','params']);
		}elseif($this->purpose == self::ITEM_TYPE_ARTICLES){
			$this->url = Url::to('/article/list-for');
			$this->params = 'id='.$this->id;
			$this->updateAttributes(['url','params']);
		}elseif($this->purpose == self::ITEM_TYPE_URL){
			if(strpos($this->url, '{model:')!==false){
				$model_name = str_replace('{model:', '', trim($this->url));
				$model_name = str_replace('}', '', $model_name);
				$this->url = Url::to('/'.$model_name.'/list-for');
				$this->params = 'id='.$this->id;
				$this->updateAttributes(['url','params']);
			}
		}
	}
	
	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			
			// should prevent delete node with childs
			
			if(self::find()->where(['parent_id'=>$this->id])->count()>0){
				Yii::$app->session->setFlash('message', "Нельзя удалить непустой раздел!");
				return false;
			}else{
				return true;
			}
			
		} else {
			return false;
		}
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['collapsed', 'in', 'range' => [self::STATUS_COLLAPSED, self::STATUS_NOT_COLLAPSED]],
            ['level', 'default', 'value'=>1],
            ['collapsed', 'boolean'],
            ['is_dir', 'default', 'value'=>0],
            ['is_dir', 'boolean'],
			[['label','info','params','url','title','description','keywords','seourl','content','color'],'string'],
			['label','required']
			//[['file','image'], 'string', 'skipOnEmpty'=>true]
			
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'label' => 'Название',
            'color' => 'Цвет',
            'url' => 'URL (или {model:имя_модели})',
            'params' => 'Параметры GET апроса',
            'info' => 'Описание',
			'is_dir' => 'Страница или раздел',
			'title' => 'SEO title',
			'description' => 'SEO description',
			'keywords' => 'SEO keywords',
			'seourl' => 'SEO url',
			'file' => 'Файл',
			'image' => 'Изображение'
        ];
    }

    protected function _getCountOfComments(){
		$arCommentCnt = (new \yii\db\Query())
					    ->select(['COUNT(*) AS cnt', 'active'])
					    ->from('comment')
					    ->where(['parent_id' => $this->id, 'type' => 'page'])
					    ->groupBy(['active'])
					    ->all();

		$parts = ['active'=>0, 'nonactive'=>0];

		foreach($arCommentCnt as $row){
			if($row['active'] == 1){
				$parts['active'] = (int)$row['cnt'];
			}
			if($row['active'] == 0){
				$parts['nonactive'] = (int)$row['cnt'];
			}
		}

		return [
			'active'=>$parts['active'],
			'nonactive'=>$parts['nonactive'],
			'sum'=>$parts['active'] + $parts['nonactive']
		];
	}

    public function getMenu(){

		if($this->isNewRecord){
			return [];
		}

		
		$arCountOfComments = $this->_getCountOfComments();

		return [
			[
				'label'=>'Комментарии ('.$arCountOfComments['active'].'/'.$arCountOfComments['sum'].')',
				'link'=> ['/comment/index','parent_id'=>$this->id, 'type'=>'page']
			]
		];

	}

}