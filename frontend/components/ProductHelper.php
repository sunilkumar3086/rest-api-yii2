<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 7:42 PM
 */
namespace frontend\components;

use common\models\Category;
use common\models\Product;
use Yii;
use yii\base\Component;

class ProductHelper extends Component{

    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array|bool|Product[]
     */
    public function getProducts(){
        $products = Product::find()->where(['is_active'=>Product::IS_ACTIVE])->all();
        if(!$products || !is_array($products) || count($products)==0){
            return false;
        }

        return $products;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $catId
     * @return array|bool|null|Product[]
     */
    public function getProductCategory($catId){
        if(!$catId || !is_numeric($catId)){
            return null;
        }

        $productCategories = Product::find()->where(['is_active'=>Product::IS_ACTIVE])->andWhere(['main_category'=>$catId])->all();
        if(!$productCategories || !is_array($productCategories) || count($productCategories)==0){
            return false;
        }

        return $productCategories;
    }


}