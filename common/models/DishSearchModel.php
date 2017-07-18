<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Dish;

/**
 * DishSearchModel represents the model behind the search form about `common\models\Dish`.
 */
class DishSearchModel extends Dish
{
    public $ingredient;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visible', 'created_at', 'updated_at'], 'integer'],
            [['ingredient', 'name', 'description', 'fname'], 'safe'],
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
        $query = Dish::find();
        $query->joinWith(['ingredients']); // связь

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['ingredient'] = [
            'asc' => ['ingredient.name' => SORT_ASC],
            'desc' => ['ingredient.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'visible' => $this->visible,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ])->andFilterWhere(['like', 'ingredient.name', $this->ingredient]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fname', $this->fname]);

        return $dataProvider;
    }
}
