<?php

namespace backend\models\article;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\article\ArticleRecord;

/**
 * ArticleSearch represents the model behind the search form about `backend\models\article\ArticleRecord`.
 */
class ArticleSearch extends ArticleRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'created_at', 'updated_at', 'active_from', 'sort', 'active'], 'integer'],
            [['name', 'preview_text', 'detail_text', 'soc_text', 'keywords', 'title', 'description', 'seourl', 'image', 'file'], 'safe'],
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
		
        $query = ArticleRecord::find()->where(['parent_id'=>$params['parent_id']]);

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
            'active_from' => $this->active_from,
            'sort' => $this->sort,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text])
            ->andFilterWhere(['like', 'detail_text', $this->detail_text])
            ->andFilterWhere(['like', 'soc_text', $this->soc_text])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'seourl', $this->seourl])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
