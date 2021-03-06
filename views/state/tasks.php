<?php

use kartik\file\FileInput;
use yii\helpers\Html;

/* @var $tasks */
/* @var $state */

foreach ($tasks as $task): ?>
    <?php if ($task->state_id == $state->id): ?>
        <div class="col-md-12 block">
            <?= Html::a('', ['/task/update?id=' . $task->id], ['class' => 'glyphicon glyphicon-pencil']) ?>
            <?= Html::a('', ['/task/delete?id=' . $task->id], ['class' => 'glyphicon glyphicon-trash',
                'data' => ['method' => 'post', 'params' => ['id' => $task->id]]]) ?>

            <?php if (!empty($task->icon)) {
                echo '<div class="col-md-3 block">';
                echo Html::activeFileInput($task, 'icon');
                echo '</div>';
            } ?>
            <?= $task->name; ?>
        </div>

    <?php endif; ?>
<?php endforeach; ?>
