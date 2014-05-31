<?php

namespace app\web;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\departamento;

/**
 * models represents the model behind the search form about `app\models\departamento`.
 */
class models extends departamento
{
    public function rules()
    {
        return [
            [['id_dep'], 'integer'],
            [['nombre_dep', 'descripcion_dep'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = departamento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_dep' => $this->id_dep,
        ]);

        $query->andFilterWhere(['like', 'nombre_dep', $this->nombre_dep])
            ->andFilterWhere(['like', 'descripcion_dep', $this->descripcion_dep]);

        return $dataProvider;
    }
}
