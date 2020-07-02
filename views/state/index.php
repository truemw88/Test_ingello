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

    <p>
        <?= Html::a('add state', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('add task', ['/task/create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php if (isset($states)): ?>
        <div class="container">
            <div class="row">

                <?php foreach ($states as $state): ?>
                    <div class="col-md-3">

                        <?= Html::a('', ['update?id=' . $state->id], ['class' => 'glyphicon glyphicon-pencil']) ?>
                        <?= Html::a('', ['/task/create'], ['class' => 'glyphicon glyphicon-plus',
                            'data' => ['method' => 'post', 'params' => ['state_id' => $state->id]]]) ?>

                        <?= Html::a('', ['delete?id=' . $state->id], ['class' => 'glyphicon glyphicon-trash',
                            'data' => ['method' => 'post', 'params' => ['id' => $state->id]]]) ?>

                        <?= $state->name; ?>
                        <hr>
                        <?php if (isset($tasks)): ?>

                            <?= $this->render('tasks', ['state' => $state, 'tasks' => $tasks,]); ?>

                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
