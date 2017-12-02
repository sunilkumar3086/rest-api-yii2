<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Utils;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategoryMapping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-mapping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->all(),"id","title")
        ,['prompt'=>'--Select']) ?>

    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(Category::find()->all(),'id','title'),
        ['prompt'=>'--Select--']) ?>

    <?= $form->field($model, 'is_active')->dropDownList(Utils::getYesNoList(),['prompt'=>'--Select--']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
