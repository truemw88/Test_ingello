<?php

use yii\helpers\Url;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use vova07\imperavi\Widget;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */

$arrayStates = ArrayHelper::map(
    $states, 'id', 'name');
?>



<?php $form = ActiveForm::begin(); ?>
<div class="task-form">
    <div class="col-md-6 block">
        <?= $form->field($model, 'icon')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
//                'uploadUrl' => Url::to(['/task/file-upload']),
//                'uploadExtraData' => [
//                    'album_id' => 20,
//                    'cat_id' => 'Nature'
//                ]
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'showBrowse' => false,
                'browseOnZoneClick' => true,

                'initialPreviewAsData'=>true,
                'allowedFileExtensions'=>['jpg','jpeg','gif','png'],
            ]
        ]); ?>


        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'state_id')->dropDownList(
            $arrayStates,
            ['prompt' => '',]) ?>

        <?= $form->field($model, 'priority')->textInput() ?>

        <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
                    'filemanager',
                ],
                'clips' => [
                    ['Lorem ipsum...', 'Lorem...'],
                    ['red', '<span class="label-red">red</span>'],
                    ['green', '<span class="label-green">green</span>'],
                    ['blue', '<span class="label-blue">blue</span>'],
                ],
                'imageUpload' => \yii\helpers\Url::to(['/task/image-upload']),
                'imageManagerJson' => \yii\helpers\Url::to(['/task/images-get']),
                'fileManagerJson' => \yii\helpers\Url::to(['/task/files-get']),
                'fileUpload' => \yii\helpers\Url::to(['/task/file-upload'])
            ],
        ]); ?>

    </div>

</div>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

