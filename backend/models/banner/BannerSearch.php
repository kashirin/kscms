<?php

namespace backend\models\banner;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\banner\BannerRecord;

/**
 * BannerSearch represents the model behind the search form about `backend\models\banner\BannerRecord`.
 */
class BannerSearch extends BannerRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'created_at', 'updated_at', 'sort', 'width', 'height', 'active'], 'integer'],
            [['resource', 'link', 'format', 'position', 'html'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if(!isset($params['parent_id'])){
            throw new \Exception('Property parent_id must be setted');
        }
        
        $query = BannerRecord::find()->where(['parent_id'=>$params['parent_id']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sort' => $this->sort,
            'width' => $this->width,
            'height' => $this->height,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'resource', $this->resource])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'format', $this->format])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'html', $this->html]);

        return $dataProvider;
    }
}
