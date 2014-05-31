<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lch_departamentos".
 *
 * @property string $id_dep
 * @property string $nombre_dep
 * @property string $descripcion_dep
 *
 * @property LchDepartamentosHavePersonal[] $lchDepartamentosHavePersonals
 */
class departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lch_departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_dep'], 'required'],
            [['descripcion_dep'], 'string'],
            [['nombre_dep'], 'string', 'max' => 200],
            [['nombre_dep'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dep' => Yii::t('app', 'Id Dep'),
            'nombre_dep' => Yii::t('app', 'Nombre Dep'),
            'descripcion_dep' => Yii::t('app', 'Descripcion Dep'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLchDepartamentosHavePersonals()
    {
        return $this->hasMany(LchDepartamentosHavePersonal::className(), ['id_dep' => 'id_dep']);
    }
}
