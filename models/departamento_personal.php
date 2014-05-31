<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lch_departamentos_have_personal".
 *
 * @property string $id_dep_personal
 * @property string $id_dep
 * @property string $id_personal
 *
 * @property LchDepartamentos $idDep
 * @property LchPersonal $idPersonal
 */
class departamento_personal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lch_departamentos_have_personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dep', 'id_personal'], 'required'],
            [['id_dep', 'id_personal'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dep_personal' => Yii::t('app', 'Id Dep Personal'),
            'id_dep' => Yii::t('app', 'Id Dep'),
            'id_personal' => Yii::t('app', 'Id Personal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDep()
    {
        return $this->hasOne(LchDepartamentos::className(), ['id_dep' => 'id_dep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonal()
    {
        return $this->hasOne(LchPersonal::className(), ['id_personal' => 'id_personal']);
    }
}
