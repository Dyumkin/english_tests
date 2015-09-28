<?php

namespace backend\controllers;

use common\filters\AccessRule;
use common\models\DomainI18n;
use common\models\Lang;
use Yii;
use common\models\Domain;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DomainController implements the CRUD actions for Domain model.
 */
class DomainController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => ['class' => AccessRule::className()],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [Domain::PERMISSION_CREATE],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [Domain::PERMISSION_VIEW, Domain::PERMISSION_VIEW_OWN],
                        'modelClass' => Domain::className()
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [Domain::PERMISSION_EDIT, Domain::PERMISSION_EDIT_OWN],
                        'modelClass' => Domain::className()
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Domain::PERMISSION_DELETE, Domain::PERMISSION_DELETE_OWN],
                        'modelClass' => Domain::className()
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
     * Lists all Domain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Domain::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Domain model.
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
     * Creates a new Domain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Domain();
        $modelI18ns = [];
        $hasError = false;

        /** @var Lang $lang */
        foreach (Lang::find()->all() as $lang) {
            $modelI18ns[] = new DomainI18n(['lang_id' => $lang->id]);
        }

        if (Model::loadMultiple($modelI18ns, Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            if (Model::validateMultiple($modelI18ns) && $model->validate()) {
                $model->setDomainI18ns($modelI18ns);
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            $hasError = true;
        }

        return $this->render('create', [
            'model' => $model,
            'modelI18ns' => $modelI18ns,
            'hasError' => $hasError
        ]);
    }

    /**
     * Updates an existing Domain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelI18ns = $model->domainI18ns;
        $hasError = false;

        if (Model::loadMultiple($modelI18ns, Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            if (Model::validateMultiple($modelI18ns)) {
                $model->setDomainI18ns($modelI18ns);
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            $hasError = true;
        }

        return $this->render('create', [
            'model' => $model,
            'modelI18ns' => $modelI18ns,
            'hasError' => $hasError
        ]);
    }

    /**
     * Deletes an existing Domain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!$model->domains) {
            $model->delete();
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Cannot delete, this domain is used'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Domain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Domain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Domain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
