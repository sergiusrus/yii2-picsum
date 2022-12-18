<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pic]].
 *
 * @see Pic
 */
class PicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
