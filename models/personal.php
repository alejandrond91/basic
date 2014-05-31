<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lch_personal".
 *
 * @property string $id_personal
 * @property string $nombre_personal
 * @property string $nif_personal
 * @property string $direccion_personal
 * @property string $rendimiento_personal
 *
 * @property LchDepartamentosHavePersonal[] $lchDepartamentosHavePersonals
 */
class personal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lch_personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nif_personal'], 'required'],
            [['rendimiento_personal'], 'number'],
            [['nombre_personal', 'direccion_personal'], 'string', 'max' => 200],
            [['nif_personal'], 'string', 'max' => 45],
            [['nif_personal'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_personal' => Yii::t('app', 'Id Personal'),
            'nombre_personal' => Yii::t('app', 'Nombre Personal'),
            'nif_personal' => Yii::t('app', 'Nif Personal'),
            'direccion_personal' => Yii::t('app', 'Direccion Personal'),
            'rendimiento_personal' => Yii::t('app', 'Rendimiento Personal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLchDepartamentosHavePersonals()
    {
        return $this->hasMany(LchDepartamentosHavePersonal::className(), ['id_personal' => 'id_personal']);
    }
}
