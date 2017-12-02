<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 7:51 PM
 */

namespace frontend\models\response;


class CategoryApiResponse extends FrontendApiResponse{

    public $id;
    public $name;

    //------------------------------------------------------------------------------------------------------------------
    public  function rules(){
        return [
            [['id','name'],'required'],
            [['id'],'integer'],
            [['name'],'string']
        ];

    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'id'=>'id',
            'name'=> 'name',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function loadFromApiResponse($data){
        if(!$data){
            return null;
        }

        $this->id = $data->id;
        $this->name = $data->title;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'id',
            'name',
        ];
    }

}