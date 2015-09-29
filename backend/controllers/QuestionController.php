<?php

namespace backend\controllers;

use common\filters\AccessRule;
use common\models\User;
use Yii;
use common\models\question\Question;
use common\models\search\QuestionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use common\models\question\iQuestion;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
                        'roles' => [Question::PERMISSION_CREATE],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [Question::PERMISSION_VIEW, Question::PERMISSION_VIEW_OWN],
                        'modelClass' => Question::className()
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [Question::PERMISSION_EDIT, Question::PERMISSION_EDIT_OWN],
                        'modelClass' => Question::className()
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Question::PERMISSION_DELETE, Question::PERMISSION_DELETE_OWN],
                        'modelClass' => Question::className()
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * @param string $type
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate($type)
    {
        $model = new Question();

        if (!array_key_exists($type, Question::getRelationClassNames())) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $class = Question::getRelationClassNames()[$type];
        /** @var iQuestion|ActiveRecord $question */
        $question = Yii::createObject($class);

        if ($model->load(Yii::$app->request->post()) && $question->load(Yii::$app->request->post())) {
            if ($model->validate() && $question->validate()) {
                $model->setRelationQuestion($question);
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'question' => $question,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $relation = 'question' . ucfirst($model->type);

        /** @var iQuestion|ActiveRecord $question */
        $question = $model->{$relation};

        if ($model->load(Yii::$app->request->post()) && $question->load(Yii::$app->request->post())) {
            if ($model->validate() && $question->validate()) {
                $model->setRelationQuestion($question);
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'question' => $question,
        ]);
    }

    /**
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
