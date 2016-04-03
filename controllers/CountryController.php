<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
	public function actionIndex()
	{
		$query = Country::find();

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $query->count()
		]);

		$countries  = $query->orderBy('name')->offset($pagination->offset)->limit($pagination->limit)->all();

		return $this->render('index',[
			'countries' => $countries,
			'pagination' => $pagination
		]);
	}

	public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


	public function actionCreate()
    {
        if (!Yii::$app->user->can("admin")) {
            return $this->redirect(['index']);
        }

        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can("admin")) {
            return $this->redirect(['index']);
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        if (!Yii::$app->user->can("admin")) {
            return $this->redirect(['index']);
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {

        if (($model = Country::find()->where(['code' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>