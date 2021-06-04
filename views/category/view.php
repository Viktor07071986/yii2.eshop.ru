<?php

use yii\helpers\Html;
use app\components\MenuWidget;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>

<section id="advertisement">
    <div class="container">
        <img src="/images/shop/1.jpg" alt="" />
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul>
                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?= $category->name?></h2>
                    <?php if(!empty($products)) { ?>
                        <?php foreach($products as $product) { ?>
                            <?php $mainImg = $product->getImage();?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper" style="height: 400px;">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img($mainImg->getUrl('268x249'), ['alt' => $product->name])?>
                                            <h2><?= $product->price?> руб.</h2>
                                            <p><a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name?></a></p>
                                            <a href="#" data-id="<?= $product->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <?php if($product->new) { ?>
                                            <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new'])?>
                                        <?php } ?>
                                        <?php if($product->sale) { ?>
                                            <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new'])?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                        <?php echo LinkPager::widget(['pagination' => $pages]); ?>
                    <?php } else { ?>
                        <h2>Здесь товаров пока нет...</h2>
                    <?php } ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
<div style="clear: both; height: 50px;"></div>