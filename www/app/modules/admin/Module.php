<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'basicAuth' => [
                    'class' => \yii\filters\auth\QueryParamAuth::class
                ],
            ]
        );
    }
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->setLayoutPath('@app/modules/admin/views/layouts');
        Yii::$app->layout = 'admin';
    }
}
