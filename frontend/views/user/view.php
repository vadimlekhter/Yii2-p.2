<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \common\models\ProjectUser;
use \common\models\User;
use \yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'avatar',
                'label' => Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW)),
                'value' => ''
            ],
            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return User::STATUS_LABELS[$model->status];
                }
            ],
//            'created_at',
//            'updated_at',
//            'verification_token',
//            'access_token',
//            'avatar',
        ],
    ]) ?>

    <?php
    if (!$dataProvider == null) {
        echo '<h2>Users projects</h2>';
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label' => 'Project',
                    'value' => function (ProjectUser $model) {
                        return Html::a($model->project->title,
                            ['project/view', 'id' => $model->project_id]);

                    },
                    'format' => 'html'],
                'role',
            ]]);
    }
    ?>

</div>
