<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\question\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\question\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'domain_id', 'update_at', 'create_at', 'created_by', 'updated_by'], 'integer'],
            [['type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Question::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->update_at) {

            $updateAt = \DateTime::createFromFormat('d-m-Y', $this->update_at);
            $updateAt->setTime(0,0,0);

            $unixDateStart = $updateAt->getTimeStamp();

            $updateAt->add(new \DateInterval('P1D'));
            $updateAt->sub(new \DateInterval('PT1S'));

            $unixDateEnd = $updateAt->getTimeStamp();

            $query->andFilterWhere(
                ['between', 'update_at', $unixDateStart, $unixDateEnd]);

            $this->update_at = '';
        }

        if ($this->create_at) {

            $createAt = \DateTime::createFromFormat('d-m-Y', $this->create_at);
            $createAt->setTime(0,0,0);

            $unixDateStart = $createAt->getTimeStamp();

            $createAt->add(new \DateInterval('P1D'));
            $createAt->sub(new \DateInterval('PT1S'));

            $unixDateEnd = $createAt->getTimeStamp();

            $query->andFilterWhere(
                ['between', 'create_at', $unixDateStart, $unixDateEnd]);

            $this->create_at = '';
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'domain_id' => $this->domain_id,
            'create_at' => $this->create_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
