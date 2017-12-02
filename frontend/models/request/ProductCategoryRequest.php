<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 9:45 PM
 */

namespace frontend\models\request;


class ProductCategoryRequest extends FrontendApiRequest{

    public $categoryId;

    public function rules(){
        return [
            [['categoryId'],'required'],
            [['categoryId'],'integer'],
        ];
    }

}