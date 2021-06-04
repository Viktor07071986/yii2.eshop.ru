<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends AppAdminController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $this->setMeta("Категории", "Категории", "Категории");
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->with('category'),
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
                'forcePageParam' => false
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);
        $query_category = "SELECT c1.* FROM category as c1 INNER JOIN category as c2 ON (c1.id = c2.parent_id) WHERE c1.parent_id = 0 AND c1.id = ".$id." ";
        $count_parent_category = Category::findBySql($query_category)->asArray()->count();
        $query_product = "SELECT c.* FROM category as c INNER JOIN product as p ON (c.id = p.category_id) WHERE c.id = ".$id." ";
        $count_parent_product = Category::findBySql($query_product)->asArray()->count();
        $this->setMeta("Просмотр категории № " . $model->id, "Просмотр категории", "Просмотр категории");
        return $this->render('view', compact('model', 'count_parent_category', 'count_parent_product'));
    }

    public function actionCreate() {
        $this->setMeta("Создать категорию", "Создать категорию", "Создать категорию");
        $model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $this->setMeta("Изменить категорию № " . $model->id, "Изменить категорию", "Изменить категорию");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}