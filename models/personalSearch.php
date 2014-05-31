<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\personal;

/**
 * personalSearch represents the model behind the search form about `app\models\personal`.
 */
class personalSearch extends personal
{
    public function rules()
    {
        return [
            [['id_personal'], 'integer'],
            [['nombre_personal', 'nif_personal', 'direccion_personal'], 'safe'],
            [['rendimiento_personal'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = personal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_personal' => $this->id_personal,
            'rendimiento_personal' => $this->rendimiento_personal,
        ]);

        $query->andFilterWhere(['like', 'nombre_personal', $this->nombre_personal])
            ->andFilterWhere(['like', 'nif_personal', $this->nif_personal])
            ->andFilterWhere(['like', 'direccion_personal', $this->direccion_personal]);

        return $dataProvider;
    }
}
