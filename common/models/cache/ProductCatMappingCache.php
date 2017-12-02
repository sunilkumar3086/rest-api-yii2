<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 6:25 PM
 */
namespace common\models\cache;

use yii\base\Model;

class ProductCatMappingCache extends Model{

    public $id;
    public $title;


    public function rules(){
        return [
            [['id', 'title'], 'required'],
            [['id'],'integer'],
            [['title'],'string'],
        ];
    }

}