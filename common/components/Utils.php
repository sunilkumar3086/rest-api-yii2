<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 4:32 PM
 */
namespace common\components;

class Utils{

    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array
     */
    public static function getYesNoList(){
        $list=[0=>'No',1=>'Yes'];
        return $list;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public static function getNow(){
        return \Yii::$app->formatter->asDatetime("NOW", "php:Y-m-d H:i:s");
    }

}