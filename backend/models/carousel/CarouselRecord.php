<?php

namespace backend\models\carousel;

use Yii;
use yii\base\NotSupportedException;
use backend\traits\AdminFormTrait;

/**
 * This is the model class for table "carousel".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $active
 * @property integer $sort
 * @property string $url
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 */
class CarouselRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carousel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            ['active', 'in', 'range' => [self::$STATUS_IS_ACTIVE, self::$STATUS_IS_NOT_ACTIVE]],
            ['active', 'default','value'=>self::$STATUS_IS_ACTIVE],
            ['active', 'boolean'],
            [['active', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 250]
        ];
    }

    public function getCaptions(){
    
        return [
            'elements' => 'Баннеры для карусели',
            'element' => 'Баннер для карусели',
            'add_element' => 'Добавить баннер',
            'update_element' => 'Редактировать баннер',
            'delete_element' => 'Удалить баннер'
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
                'label'=>'Активна',
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
            
            'url'=>[
                'label'=>'URL',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'image'=>[
                'label'=>'Изображение',
                'detail'=>true,
                'grid'=>true,
                'type'=>'image'
            ],
            ];
    }


}
