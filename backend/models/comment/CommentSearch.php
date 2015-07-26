<?php

namespace backend\models\comment;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\comment\CommentRecord;


class CommentSearch extends CommentRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'created_at', 'updated_at', 'sort', 'user_id', 'active'], 'integer'],
            [['type', 'text'], 'safe'],
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
        // only for comments this way
        $query = CommentRecord::find()->where($this->getParentParams());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 3,
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
            'user_id' => $this->user_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
