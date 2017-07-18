<?php

namespace backend\controllers;

use Yii;
use common\models\Dish;
use common\models\DishSearchModel;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dish();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'load_picture');
                if ($file) {
                    $isJPG = strstr($file->name, "PNG", "JPG"); // проверка на расширение из прописных букв
                    $file->saveAs('../../uploads/dish/' . $file->baseName . '.' . $file->extension);
                    if (!$isJPG) {
                        $model->fname = $file->baseName . '.' . $file->extension;
                    } else {
                        $model->fname = $file->baseName . strtoupper('.' . $file->extension);
                    }
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::$app->session('error', 'Ошибка');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'load_picture');
                if ($file) {
                    $isJPG = strstr($file->name, "PNG", "JPG"); // проверка на расширение из прописных букв
                    $file->saveAs('../../uploads/dish/' . $file->baseName . '.' . $file->extension);
                    if (!$isJPG) {
                        $model->fname = $file->baseName . '.' . $file->extension;
                    } else {
                        $model->fname = $file->baseName . strtoupper('.' . $file->extension);
                    }
                }
                if (!$file && $model->fname) // если файл не добавлен - сохраняем существующий
                {
                    $model->fname = $this->findModel($id)->fname;
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::$app->session('error', 'Ошибка');
            }
        }
        else {
            $model->load(Yii::$app->request->get());
            $model->id_ingredient = \yii\helpers\ArrayHelper::map($model->ingredients, 'name', 'name');

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
