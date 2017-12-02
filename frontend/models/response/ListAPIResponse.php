<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 7:50 PM
 */

namespace frontend\models\response;


class ListAPIResponse extends FrontendApiResponse{

    public $data = [];

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['data'],'required'],
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'data' => 'data',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function addData(FrontendApiResponse $data){
        if(!$data || !$data->validate()){
            return;
        }

        array_push($this->data,$data);
    }
    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [
            'data' => 'dt',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'data' => 'data',
        ];
    }
}