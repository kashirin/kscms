<?php

namespace backend\models\event;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use backend\traits\AdminFormTrait;
use backend\behaviors\AdminFormBehavior;


class EventRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','description'], 'required'],
            ['active', 'in', 'range' => [self::$STATUS_IS_ACTIVE, self::$STATUS_IS_NOT_ACTIVE]],
            ['active', 'default','value'=>self::$STATUS_IS_ACTIVE],
            ['active', 'boolean'],
            [['sort', 'created_at', 'updated_at'], 'integer'],
            [['description','eventdate'], 'string'],
            [['eventactive', 'name'], 'string', 'max' => 250],
            [['eventtime'], 'string', 'max' => 5],
            [['eventtime'], 'default', 'value' => '14:00']
        ];
    }

    public function getCaptions(){
    
        return [
            'elements' => 'События таблицы календаря событий',
            'element' => 'Событие календаря событий',
            'add_element' => 'Добавить событие',
            'update_element' => 'Редактировать событие',
            'delete_element' => 'Удалить событие'
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
                'grid'=>true,
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
            'name'=>[
                'label'=>'Название',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'eventactive'=>[
                'label'=>'Актив',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'eventdate'=>[
                'label'=>'Дата события',
                'detail'=>true,
                'grid'=>true,
                'type'=>'date',
                'readonly'=>false
            ],
            'eventtime'=>[
                'label'=>'Время события',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string',
                'readonly'=>false
            ],
            

            'description'=>[
                'label'=>'Описание',
                'detail'=>true,
                'grid'=>true,
                'type'=>'editor'
            ],

        ];
    }


}
