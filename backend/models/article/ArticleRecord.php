<?php
namespace backend\models\article;

use Yii;
use yii\base\NotSupportedException;
use yii\base\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use backend\behaviors\AdminFormBehavior;
use common\helpers\Translit;
use backend\traits\AdminFormTrait;
use backend\models\comment\CommentRecord;

/**
 * Article model
*/
class ArticleRecord extends ActiveRecord
{
	use AdminFormTrait;
	const STATUS_IS_ACTIVE = 1;
    const STATUS_IS_NOT_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
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
	
	
	
	protected function _checkUniqueSeourl($insert){
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
	}

	protected function _fillSeourl(){
		
		if(empty($this->title)){
			$this->title = $this->name;
		}
		
		if(empty($this->seourl)){
			$this->seourl = Translit::url($this->title);
		}
	}
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
		

			//auto fill seourl


			$this->_fillSeourl();
			

			//check unique seourl
			
			$this->_checkUniqueSeourl($insert);
			
			
			return true;
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
            ['active', 'in', 'range' => [self::STATUS_IS_ACTIVE, self::STATUS_IS_NOT_ACTIVE]],
			['active', 'default','value'=>self::STATUS_IS_ACTIVE],
            ['active', 'boolean'],
			[['name','seourl','title','description','keywords','detail_text', 'preview_text', 'soc_text','active_from'],'string'],
			['name','required']
			
        ];
    }
	
	
	public function getCaptions(){
	
		return [
			'elements' => 'Статьи',
			'element' => 'Статья',
			'add_element' => 'Добавить статью',
			'update_element' => 'Редактировать статью',
			'delete_element' => 'Удалить элемент'
		];
	
	}

	
	public function getDescription(){
		return [
			'id'=>[
				'label'=>'ID',
				'detail'=>false,
				'grid'=>true,
				'type'=>'int'
			],
			'parent_id'=>[
				'label'=>'Родительский раздел',
				'detail'=>false,
				'grid'=>false,
				'type'=>'int'
			],
			'name'=>[
				'label'=>'Название',
				'detail'=>true,
				'grid'=>true,
				'type'=>'string'
			],
			'created_at'=>[
				'label'=>'Время создания',
				'detail'=>true,
				'grid'=>false,
				'type'=>'datetime',
				'readonly'=>true
			],
			'updated_at'=>[
				'label'=>'Время изменения',
				'detail'=>true,
				'grid'=>false,
				'type'=>'datetime',
				'readonly'=>true
			],
			'active'=>[
				'label'=>'Активна',
				'detail'=>true,
				'grid'=>true,
				'type'=>'checkbox',
				'values'=>[
					1=>'Да',
					0=>'Нет'
				]
			],
			'active_from'=>[
				'label'=>'Активна с',
				'detail'=>true,
				'grid'=>true,
				'type'=>'datetime'
			],	
			'sort'=>[
				'label'=>'Поле сортировки',
				'detail'=>true,
				'grid'=>true,
				'type'=>'int'
			],
			
			'title'=>[
				'label'=>'Title',
				'detail'=>true,
				'grid'=>false,
				'type'=>'string'
			],
			'description'=>[
				'label'=>'Description',
				'detail'=>true,
				'grid'=>false,
				'type'=>'string'
			],
			'keywords'=>[
				'label'=>'Keywords',
				'detail'=>true,
				'grid'=>false,
				'type'=>'string'
			],
			'seourl'=>[
				'label'=>'Url',
				'detail'=>true,
				'grid'=>false,
				'type'=>'string'
			],
			'preview_text'=>[
				'label'=>'Краткий текст',
				'detail'=>true,
				'grid'=>true,
				'type'=>'text'
			],
			'detail_text'=>[
				'label'=>'Детальный текст',
				'detail'=>true,
				'grid'=>true,
				'type'=>'editor'
			],
			'soc_text'=>[
				'label'=>'Текст для соцсети',
				'detail'=>true,
				'grid'=>false,
				'type'=>'text'
			],
			'image'=>[
				'label'=>'Картинка',
				'detail'=>true,
				'grid'=>true,
				'type'=>'image'
			],
			'file'=>[
				'label'=>'Файл',
				'detail'=>true,
				'grid'=>true,
				'type'=>'file'
			],
			
		];
	}

	protected function _getCountOfComments(){
		$arCommentCnt = (new \yii\db\Query())
					    ->select(['COUNT(*) AS cnt', 'active'])
					    ->from('comment')
					    ->where(['parent_id' => $this->id, 'type' => 'article'])
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

	public function getContextMenu(){

		if($this->isNewRecord){
			return [];
		}

		
		$arCountOfComments = $this->_getCountOfComments();

		return [
			[
				'label'=>'Комментарии ('.$arCountOfComments['active'].'/'.$arCountOfComments['sum'].')',
				'link'=> ['/comment/index','parent_id'=>'{id}', 'type'=>'article']
			]
		];

	}
}