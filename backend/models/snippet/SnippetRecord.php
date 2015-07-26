<?php

namespace backend\models\snippet;

use Yii;
use backend\traits\AdminFormTrait;


/**
 * This is the model class for table "snippet".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $active
 * @property integer $sort
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class SnippetRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'snippet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description','code'], 'required'],
            ['active', 'in', 'range' => [self::$STATUS_IS_ACTIVE, self::$STATUS_IS_NOT_ACTIVE]],
            ['active', 'default','value'=>self::$STATUS_IS_ACTIVE],
            ['active', 'boolean'],
            [['sort', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 50]
        ];
    }

     public function getCaptions(){
    
        return [
            'elements' => 'Сниппеты',
            'element' => 'Сниппет',
            'add_element' => 'Добавить сниппет',
            'update_element' => 'Редактировать сниппет',
            'delete_element' => 'Удалить сниппет'
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
                'label'=>'Активно',
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
            'code'=>[
                'label'=>'Символьный код',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'description'=>[
                'label'=>'Описание',
                'detail'=>true,
                'grid'=>false,
                'type'=>'editor'
            ],

        ];
    }
}
