<?php

namespace backend\models\comment;



use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use backend\traits\AdminFormTrait;
use backend\behaviors\AdminFormBehavior;


class CommentRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;
    const STATUS_IS_ACTIVE = 1;
    const STATUS_IS_NOT_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['active', 'in', 'range' => [self::STATUS_IS_ACTIVE, self::STATUS_IS_NOT_ACTIVE]],
            ['active', 'default','value'=>self::STATUS_IS_ACTIVE],
            ['active', 'boolean'],
            [['created_at', 'updated_at', 'sort', 'user_id', 'active'], 'integer'],
            [['text','user_name'], 'string']
        ];
    }

    protected $_typeMapping = [
        'article' => [
            'parent_model_class'=>'backend\models\article\ArticleRecord',
            'parent_controller_name' => 'article',
            'parent_name_field' => 'name'
        ],
        'page' => [
            'parent_model_class'=>'backend\models\structure\StructureRecord',
            'parent_controller_name' => 'structure',
            'parent_name_field' => 'label'
        ]
    ];

    public function getParentModelClass($type){
        $res = false;
        if(isset($this->_typeMapping[$type])){
            $res = $this->_typeMapping[$type]['parent_model_class'];
        }
        return $res;
    }

    public function getParentControlerName($type){
        $res = false;
        if(isset($this->_typeMapping[$type])){
            $res = $this->_typeMapping[$type]['parent_controller_name'];
        }
        return $res;
    }

    public function getParentNameField($type){
        $res = false;
        if(isset($this->_typeMapping[$type])){
            $res = $this->_typeMapping[$type]['parent_name_field'];
        }
        return $res;
    }

   

    public function getCaptions(){
    
        return [
            'elements' => 'Комментарии',
            'element' => 'Комменатрий',
            'add_element' => 'Добавить комментарий',
            'update_element' => 'Редактировать комментарий',
            'delete_element' => 'Удалить комментарий'
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
                'label'=>'Родительский элемент',
                'detail'=>false,
                'grid'=>false,
                'type'=>'int'
            ],

            'type'=>[
                'label'=>'Тип родителя',
                'detail'=>false,
                'grid'=>false,
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
                'label'=>'Активен',
                'detail'=>true,
                'grid'=>true,
                'type'=>'checkbox',
                'values'=>[
                    1=>'Да',
                    0=>'Нет'
                ]
            ],
            'sort'=>[
                'label'=>'Поле сортировки',
                'detail'=>true,
                'grid'=>true,
                'type'=>'int'
            ],
            
            'text'=>[
                'label'=>'Текст',
                'detail'=>true,
                'grid'=>true,
                'type'=>'text'
            ],
            'user_id'=>[
                'label'=>'ID пользователя',
                'detail'=>false,
                'grid'=>false,
                'type'=>'int'
            ],
            'user_name'=>[
                'label'=>'Имя пользователя',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
