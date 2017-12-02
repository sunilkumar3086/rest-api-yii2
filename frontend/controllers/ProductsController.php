<?php
namespace frontend\controllers;

use frontend\components\ProductHelper;
use frontend\models\request\ProductCategoryRequest;
use frontend\models\response\ListAPIResponse;
use frontend\models\response\ProductApiResponse;
use yii\base\InvalidParamException;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\ConflictHttpException;
use yii\web\Response;


/**
 * Products controller
 */
class ProductsController extends RestController
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
                    'category' => ['get'],
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
        $helper = new ProductHelper();
        $products = $helper->getProducts();
        if(!$products){
            throw new ConflictHttpException("No list found");
        }

        $_response = new ListAPIResponse();

        foreach ($products as $product){
            $response = new ProductApiResponse();
            $response->loadFromApiResponse($product);
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
    public function actionCategory(){
        $catId = \Yii::$app->request->get('categoryId',null);
        if(!$catId || !is_numeric($catId)){
            throw new InvalidParamException();
        }

        $request = new ProductCategoryRequest();
        $request->categoryId = $catId;
        if(!$request->validate()){
            throw new ConflictHttpException("Invalid Request");
        }

        $helper = new ProductHelper();
        $products = $helper->getProductCategory($request->categoryId);
        if(!$products){
            throw new ConflictHttpException("No list found");
        }


        $_response = new ListAPIResponse();

        foreach ($products as $product){
            $response = new ProductApiResponse();
            $response->loadFromApiResponse($product);
            if($response->validate()){
                $_response->addData($response);
            }
        }

        if(!$_response->validate()){
            throw new ConflictHttpException("Response Data invalid");
        }

        return $this->sendResponse($_response);

    }





}
