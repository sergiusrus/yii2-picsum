<?php
namespace app\jobs;

use app\models\Pic;

class PicIdSave extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public int $image_id;
    public int $approval;

    /**
     * @inheritDoc
     */
    public function execute($queue)
    {
        $model = new Pic();
        $model->image_id = $this->image_id;
        $model->is_approved = $this->approval;
        $model->save();
    }
}