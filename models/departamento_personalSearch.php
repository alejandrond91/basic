<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\departamento_personal;

/**
 * departamento_personalSearch represents the model behind the search form about `app\models\departamento_personal`.
 */
class departamento_personalSearch extends departamento_personal
{
    public function rules()
    {
        return [
            [['id_dep_personal', 'id_dep', 'id_personal'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = departamento_personal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_dep_personal' => $this->id_dep_personal,
            'id_dep' => $this->id_dep,
            'id_personal' => $this->id_personal,
        ]);

        return $dataProvider;
    }
}
