<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pics".
 *
 * @property int $id
 * @property int|null $image_id ID изображения
 * @property bool|null $is_approved Одобрен
 */
class Pic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id'], 'default', 'value' => null],
            [['image_id'], 'integer'],
            [['is_approved'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'ID изображения',
            'is_approved' => 'Одобрен',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PicQuery(get_called_class());
    }
}
