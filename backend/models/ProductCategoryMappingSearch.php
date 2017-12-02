<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCategoryMapping;

/**
 * ProductCategoryMappingSearch represents the model behind the search form about `common\models\ProductCategoryMapping`.
 */
class ProductCategoryMappingSearch extends ProductCategoryMapping
{
    const PRODUCT_CATE_MAPPING_CREATE = "___create";
    const PRODUCT_CATE_MAPPING_UPDATE = "___update";

    public $productName;
    public $categoryName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'cat_id', 'is_active',], 'required','on'=>[self::PRODUCT_CATE_MAPPING_CREATE,self::PRODUCT_CATE_MAPPING_UPDATE]],
            [['id', 'product_id', 'cat_id', 'is_active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','productName','categoryName'], 'safe'],
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
        $query = ProductCategoryMapping::find()->innerJoinWith(['product','cat']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'cat_id' => $this->cat_id,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
