<?php
namespace frontend\controllers;

use frontend\components\CategoryHelper;
use frontend\models\response\CategoryApiResponse;
use frontend\models\response\ListAPIResponse;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\ConflictHttpException;
use yii\web\Response;


/**
 * Category  controller
 */
class CategoryController extends RestController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'content'=> [
                'class' => ContentNegotiator::className(),
                'formats'=> [
                    'application/json' => Response::FORMAT_JSON
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }


    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return array|\common\models\api\response\APIResponse
     * @throws ConflictHttpException
     */
    public function actionIndex()
    {
        $helper = new CategoryHelper();
        $categories = $helper->getCategories();
        if(!$categories){
            throw new ConflictHttpException("No list found");
        }

        $_response = new ListAPIResponse();

        foreach ($categories as $cate){
            $response = new CategoryApiResponse();
            $response->loadFromApiResponse($cate);
            if($response->validate()){
                $_response->addData($response);
            }
        }

        if(!$_response->validate()){
            throw new ConflictHttpException("Response Data invalid");
        }

        return $this->sendResponse($_response);

    }

    //------------------------------------------------------------------------------------------------------------------






}
