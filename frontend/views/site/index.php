<?php

/* @var $this yii\web\View */

$this->title = 'GRDASH';
?>

<header>
    <h1><strong>GR</strong>Dash</h1>
</header>

<div class="row">
    <div class="col-xs-12 col-sm-4">
        <?php echo $this->render("_category")?>
    </div>

    <div class="col-xs-12 col-sm-8">
        <?php echo $this->render("_product")?>
    </div>

</div>

<?php echo $this->render("_product_cat")?>
