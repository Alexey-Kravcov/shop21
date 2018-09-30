<?php

namespace common\models\users;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\users\Profile;

/**
 * ProfileSearch represents the model behind the search form about `backend\models\users\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gender', 'image', 'created_at', 'updated_at'], 'integer'],
            [['name', 'birthday', 'phone', 'status', 'address'], 'safe'],
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
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'gender' => $this->gender,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
