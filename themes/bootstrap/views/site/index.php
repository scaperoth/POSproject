<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="text-center">
    <?php
    echo BSHtml::jumbotron('<span class="white_shadow">Welcome to the<br>Db & Team Project Page</span>', <<< TEXT
   <blockquote class="text-center" style="border:none">
    <p style="color:#999;" class="white_shadow"><i class="fa fa-quote-left fa-lg fa-fw white_shadow"></i> It's just a job. Grass grows, birds fly, waves pound the sand. I beat people up.<i class="fa fa-quote-right fa-lg fa-fw white_shadow"></i></p>
    <footer style="color:#999;">Muhammad Ali</footer>
    </blockquote>
        
TEXT
            .
            BSHtml::button('Call to Action', array(
                'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                'class' => 'btn-lg',
            )), array(
        'style' => 'background: url(' . Yii::app()->theme->baseUrl . '/assets/images/bg1_sm_with_overlay_noise.png) center;',
            //'style'=>'background: #555;',
            )
    );
    ?>
</div>


<div class="col-sm-8 col-sm-offset-2 ">
    <?php if (!Yii::app()->user->isGuest): ?>
        <?php if (!Yii::app()->user->isEmployee()): ?>
            <h1> Welcome, <?= ucfirst(Yii::app()->user->fname); ?>.</h1>
        <?php endif; ?>
        <?php if (Yii::app()->user->isEmployee()): ?>
            <h1> Welcome, <?= ucfirst(Yii::app()->user->fname) .' ('.ucfirst(Yii::app()->user->title).')'; ?>.</h1>
        <?php endif; ?>
    <?php endif; ?>
    <blockquote>
        <h3>About Us</h3>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
    </blockquote>
    <div class="row">
        <div class="col-md-4">
            <a href="<?= Yii::app()->createUrl("item/catalog");?>"><div class="bubble-icon fade-bg "><i class="fa fa-shopping-cart fa-lg fade-bg fade-red fade-white-font"></i> </div></a>
            <h2 >Shop</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <a href="#"><div class="bubble-icon fade-bg "><i class="fa fa-beer fa-lg fade-bg fade-red fade-white-font"></i> </div></a>
            <h2>About</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
             <a href="#"><div class="bubble-icon fade-bg "><i class="fa fa-calendar-o fa-lg fade-bg fade-red fade-white-font"></i> </div></a>
            <h2>Contact</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>