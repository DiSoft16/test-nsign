<?php

namespace backend\controllers;

use Yii;
use common\models\Ingredient;
use common\models\IngredientSearchModel;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IngredientController implements the CRUD actions for Ingredient model.
 */
class IngredientController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete'],
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
     * Lists all Ingredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingredient model.
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
     * Creates a new Ingredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ingredient();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'load_picture');
                if ($file) {
                    $isJPG = strstr($file->name, "PNG", "JPG"); // проверка на расширение из прописных букв
                    $file->saveAs('../../uploads/ingredient/' . $file->baseName . '.' . $file->extension);
                    if (!$isJPG) {
                        $model->fname = $file->baseName . '.' . $file->extension;
                    } else {
                        $model->fname = $file->baseName . strtoupper('.' . $file->extension);
                    }
                }
                $model->save();
                return $this->redirect(['index']);
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
     * Updates an existing Ingredient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $previous = $model->visible;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($previous != $model->visible)
                {
                    \common\models\Dish::SetVisibleDish($model->id);
                }
                $file = UploadedFile::getInstance($model, 'load_picture');
                if ($file) {
                    $isJPG = strstr($file->name, "PNG", "JPG"); // проверка на расширение из прописных букв
                    $file->saveAs('../../uploads/ingredient/' . $file->baseName . '.' . $file->extension);
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
                return $this->redirect(['index']);
            } else {
                \Yii::$app->session('error', 'Ошибка');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ingredient model.
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
     * Finds the Ingredient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingredient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
