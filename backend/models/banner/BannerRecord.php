<?php

namespace backend\models\banner;

use Yii;
use backend\traits\AdminFormTrait;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property string $resource
 * @property string $link
 * @property integer $width
 * @property integer $height
 * @property string $format
 * @property string $position
 * @property integer $active
 * @property string $html
 */
class BannerRecord extends \yii\db\ActiveRecord
{
    use AdminFormTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'format', 'position'], 'required'],
            ['active', 'in', 'range' => [self::$STATUS_IS_ACTIVE, self::$STATUS_IS_NOT_ACTIVE]],
            ['active', 'default','value'=>self::$STATUS_IS_ACTIVE],
            ['active', 'boolean'],

            [['parent_id', 'created_at', 'updated_at', 'sort', 'width', 'height', 'active'], 'integer'],
            [['link', 'format', 'html'], 'string']
        ];
    }

    public function getCaptions(){
    
        return [
            'elements' => 'Баннеры',
            'element' => 'Баннер',
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
            
            'link'=>[
                'label'=>'URL',
                'detail'=>true,
                'grid'=>true,
                'type'=>'string'
            ],
            'resource'=>[
                'label'=>'Ресурс (jpg/flash)',
                'detail'=>true,
                'grid'=>false,
                'type'=>'file'
            ],
            'width'=>[
                'label'=>'Ширина',
                'detail'=>true,
                'grid'=>false,
                'type'=>'int'
            ],
            'height'=>[
                'label'=>'Высота',
                'detail'=>true,
                'grid'=>false,
                'type'=>'int'
            ],
            'format'=>[
                'label'=>'Тип баннера',
                'detail'=>true,
                'grid'=>true,
                'type'=>'list',
                'values'=>[
                    'IMAGE'=>'Картинка',
                    'FLASH' => 'Флеш',
                    'HTML' => 'HTML'
                ]
            ],
            'position'=>[
                'label'=>'Позиция размещения',
                'detail'=>true,
                'grid'=>true,
                'type'=>'list',
                'values'=>[
                    'under_content'=>'Под контентом'
                ]
            ],
            'html'=>[
                'label'=>'HTML если есть',
                'detail'=>true,
                'grid'=>false,
                'type'=>'text'
            ],
        ];
    }
}
