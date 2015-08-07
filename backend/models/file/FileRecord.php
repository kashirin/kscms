<?php

namespace backend\models\file;

use Yii;
use backend\traits\AdminFormTrait;


class FileRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
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
            [['name'], 'string'],
            [['code'], 'string', 'max' => 50]
        ];
    }

     public function getCaptions(){
    
        return [
            'elements' => 'Файлы',
            'element' => 'Файл',
            'add_element' => 'Добавить файл',
            'update_element' => 'Редактировать файл',
            'delete_element' => 'Удалить файл'
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
            'name'=>[
                'label'=>'Имя',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'file'=>[
                'label'=>'Файл',
                'detail'=>true,
                'grid'=>true,
                'type'=>'file'
            ],
        ];
    }
}
