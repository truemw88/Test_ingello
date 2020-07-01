<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'States';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (isset($states)): ?>
        <div class="container">
            <div class="row">

                <?php foreach ($states as $state): ?>
                    <div class="col-md-3">
                        <?= Html::a('', ['update?id=' . $state->id], ['class' => 'glyphicon glyphicon-pencil']) ?>
                        <?= Html::a('', ['delete?id=' . $state->id], ['class' => 'glyphicon glyphicon-trash']) ?>

                        <?= $state->name; ?>
                        <br>

                        <?php if (isset($tasks)): ?>
                            <?php foreach ($tasks as $task): ?>
                                <?php if ($task->state_id == $state->id): ?>
                                    <div class="col-md-12 block">
                                        <?= Html::a('', ['/task/update?id=' . $task->id], ['class' => 'glyphicon glyphicon-pencil']) ?>
                                        <?= Html::a('', ['/task/delete?id=' . $task->id], ['class' => 'glyphicon glyphicon-trash',
                                            'data' => [
                                                'method' => 'post',
                                                'params' => ['id' => $task->id], // <- extra level
                                            ],]) ?>
                                        <?= $task->name; ?>
                                    </div>


                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>




    <?php Pjax::begin(); ?>




    <?php Pjax::end(); ?>

</div>
