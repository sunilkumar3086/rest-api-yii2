<?php
/**
 * Created by PhpStorm.
 * User: XPS
 * Date: 7/10/2015
 * Time: 12:30 PM
 */

namespace frontend\models\request;


use common\models\api\request\APIRequest;

class FrontendApiRequest extends APIRequest
{

    const OFFSET  = 0;
    const PAGE_SIZE = 10;
    public function loadFromRequest(){
        // TODO: Implement loadFromRequest() method.
    }


    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array|bool
     */
    public function getLatLong(){
        $location = \Yii::$app->request->getLocation();
        if(!$location){
            return false;
        }

        $_location = explode("|",$location);

        return $_location;
    }

}