<?php

namespace app\controllers;

use app\models\State;
use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/images/', // Directory URL address, where files are stored.
                'path' => $_SERVER['DOCUMENT_ROOT'] . '/images', // Or absolute path to directory where files are stored.
                'validatorOptions' => [
                    'maxWidth' => 1748,
                    'maxHeight' => 1240,
                ],
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'url' => '/images/', // Directory URL address, where files are stored.
                'path' => $_SERVER['DOCUMENT_ROOT'] . '/images', // Or absolute path to directory where files are stored.

            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'url' => '/images/', // Directory URL address, where files are stored.
                'path' => $_SERVER['DOCUMENT_ROOT'] . '/images', // Or absolute path to directory where files are stored.

            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/images/', // Directory URL address, where files are stored.
                'path' => $_SERVER['DOCUMENT_ROOT'] . '/images', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false,
                'translit' => true,
                'validatorOptions' => [
                    'maxSize' => 400000
                ]
            ],
        ];
    }


    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();
        isset($_POST['state_id']) ? $model->state_id = $_POST['state_id'] : false;
        $states = State::getState();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/state/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'states' => $states,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $states = State::getState();

        if ($model->load(Yii::$app->request->post())) {

//                $model->icon = UploadedFile::getInstance($model, 'icon');
//                $model->upload();
//            de($model->icon);
//            }
            !$model->validate() ? de($model->errors) : $model->save();

            return $this->redirect(['/state/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'states' => $states,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['/state/index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
