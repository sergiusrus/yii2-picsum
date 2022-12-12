<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pic;

/**
 * PicSearch represents the model behind the search form of `app\models\Pic`.
 */
class PicSearch extends Pic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'image_id'], 'integer'],
            [['is_approved'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Pic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'image_id' => $this->image_id,
            'is_approved' => $this->is_approved,
        ]);

        return $dataProvider;
    }
}
