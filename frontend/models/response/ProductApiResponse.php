<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 7:56 PM
 */

namespace frontend\models\response;


use common\components\cache\ProductCategoryMappingHelper;

class ProductApiResponse extends FrontendApiResponse{

    public $id;
    public $name;
    public $category;
    public $categories = [];

    public function rules(){
        return [
            [['id','name','category'],'required'],
            [['categories'],'safe'],
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function loadFromApiResponse($data){
        if(!$data){
            return null;
        }

        $this->id = $data->id;
        $this->name = $data->title;
        $this->category = $data->main_category;
        $this->categoriesList($data->id);
    }

    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [
            'id' =>'id',
            'name' => 'name',
            'category' => 'mainCategory',
            'categories' => 'categories',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'id',
            'name',
            'category',
            'categories'
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    private function categoriesList($id){
        if(!$id || !is_numeric($id)){
            return null;
        }
        $helper = ProductCategoryMappingHelper::getInstance();
        $categories = $helper->getProductCatData($id);
        if(!$categories || !is_array($categories) || count($categories)==0){
            return null;
        }
        foreach ($categories as $cate){
            $response = new CategoryApiResponse();
            $response->loadFromApiResponse($cate);
            if($response->validate()){
                $this->addCategories($response);
            }
        }
    }
    //------------------------------------------------------------------------------------------------------------------
    private function addCategories($category){
        if(!$category){
            return null;
        }
        array_push($this->categories,$category);
    }

}