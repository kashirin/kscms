<?php

namespace backend\models\event;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\event\EventRecord;

/**
 * EventSearch represents the model behind the search form about `backend\models\event\EventRecord`.
 */
class EventSearch extends EventRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'active', 'sort', 'eventdate', 'created_at', 'updated_at'], 'integer'],
            [['eventactive', 'name', 'url', 'description'], 'safe'],
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
        
        $query = EventRecord::find()->where(['parent_id'=>$params['parent_id']]);

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
            'active' => $this->active,
            'sort' => $this->sort,
            'eventdate' => $this->eventdate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'eventactive', $this->eventactive])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
