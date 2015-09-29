<?php

namespace backend\controllers;

use common\filters\AccessRule;
use common\models\Lang;
use common\models\LevelI18n;
use common\models\User;
use Yii;
use common\models\Level;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LevelController implements the CRUD actions for Level model.
 */
class LevelController extends Controller
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
                        'roles' => [User::ROLE_ADMIN, User::ROLE_CLIENT],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [Level::PERMISSION_CREATE],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [Level::PERMISSION_VIEW, Level::PERMISSION_VIEW_OWN],
                        'modelClass' => Level::className()
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [Level::PERMISSION_EDIT, Level::PERMISSION_EDIT_OWN],
                        'modelClass' => Level::className()
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Level::PERMISSION_DELETE, Level::PERMISSION_DELETE_OWN],
                        'modelClass' => Level::className()
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
     * Lists all Level models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Level::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Level model.
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
     * Creates a new Level model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Level();
        $modelI18ns = [];
        $hasError = false;

        /** @var Lang $lang */
        foreach (Lang::find()->each() as $lang) {
            $modelI18ns[] = new LevelI18n(['lang_id' => $lang->id]);
        }

        if (Model::loadMultiple($modelI18ns, Yii::$app->request->post())) {
            if (Model::validateMultiple($modelI18ns)) {
                $model->setLevelI18ns($modelI18ns);
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
     * Updates an existing Level model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelI18ns = $model->levelI18ns;
        $hasError = false;

        if (Model::loadMultiple($modelI18ns, Yii::$app->request->post())) {
            if (Model::validateMultiple($modelI18ns)) {
                $model->setLevelI18ns($modelI18ns);
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
     * Deletes an existing Level model.
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
            Yii::$app->session->setFlash('error', Yii::t('app', 'Cannot delete, some domain use this level'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Level model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Level the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Level::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
