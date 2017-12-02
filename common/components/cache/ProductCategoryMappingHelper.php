<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 4:59 PM
 */
namespace common\components\cache;

use common\models\cache\ProductCatMappingCache;
use common\models\Category;
use common\models\ProductCategoryMapping;
use Yii;
use yii\caching\DbDependency;

class ProductCategoryMappingHelper{

    private static $obj = null;
    const PRODUCT_CATEGORY_CACHE_DATA_CACHE_KEY = "__prodcut_category_mapping_data_cache_key";

    //------------------------------------------------------------------------------------------------------------------
    public static function getInstance(){
        if(!self::$obj || !(self::$obj instanceof ProductCategoryMappingHelper)){
            self::$obj = new ProductCategoryMappingHelper();
        }
        return self::$obj = new ProductCategoryMappingHelper();
    }

    //------------------------------------------------------------------------------------------------------------------
    private function __construct() {

    }
    //------------------------------------------------------------------------------------------------------------------
    private function __clone() {
        // Stopping Clonning of Object
    }
    //------------------------------------------------------------------------------------------------------------------
    private function __wakeup() {
        // Stopping unserialize of object
    }

    //------------------------------------------------------------------------------------------------------------------
    public function getProductCatData($p_id){
        $categoryData = $this->getAllProductCategory();
        $key = $this->getCacheKey($p_id);
        if(!$categoryData || !is_array($categoryData) || !isset($categoryData[$key])){
            return array();
        }
        return $categoryData[$key];
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return array|bool
     */
    private function getAllProductCategory(){
        $allCategories = Yii::$app->dataCache->get(self::PRODUCT_CATEGORY_CACHE_DATA_CACHE_KEY);
        if($allCategories===false){
            $dependency = new DbDependency([
                'sql' => 'SELECT MAX(updated_at) FROM product_category_mapping',
            ]);

            $productCategoryData = ProductCategoryMapping::find()->from(['pcatm'=>ProductCategoryMapping::tableName()])
                ->innerJoinWith(['cat'])
                ->where(['pcatm.is_active'=>ProductCategoryMapping::IS_ACTIVE])->andWhere(['category.is_active'=>Category::IS_ACTIVE])->all();
            $allCategories = [];
            foreach ($productCategoryData as $product_cat) {
                $_products = [];
                /** @var ProductCategoryMapping $product_cat */

                $key = $this->getCacheKey($product_cat->product_id);

                if(isset($allCategories[$key])){
                    $_products = $allCategories[$key];
                }
                $_data = $this->loadCacheData($product_cat);
                if($_data->validate()){
                    array_push($_products,$_data);
                }
                $allCategories[$key]=$_products;
            }



            Yii::$app->dataCache->set(self::PRODUCT_CATEGORY_CACHE_DATA_CACHE_KEY, $allCategories,43200, $dependency); //FOR 12 HOURS
        }
        return $allCategories;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $productId
     * @return string
     */
    private function getCacheKey($productId){
        return sprintf("%s_%s","prod_cat",$productId);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $_productCat
     * @return ProductCatMappingCache
     */
    private function loadCacheData($_productCat){
        $_data = new ProductCatMappingCache();

        $category = $_productCat->cat;
        /**@var Category $category */;
        $_data->id = $category->id;
        $_data->title = $category->title;
        return $_data;
    }

}