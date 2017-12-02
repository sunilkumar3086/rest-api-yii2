<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 7:42 PM
 */
namespace frontend\components;

use common\models\Category;
use Yii;
use yii\base\Component;

class CategoryHelper extends Component{

    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array|bool|Category[]
     */
    public function getCategories(){
        $categories = Category::find()->where(['is_active'=>Category::IS_ACTIVE])->all();
        if(!$categories || !is_array($categories) || count($categories)==0){
            return false;
        }
        return $categories;
    }


}