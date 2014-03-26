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
                'class'=>'btn-lg',
            )),
            array(
                'style'=>'background: url('.Yii::app()->theme->baseUrl.'/assets/images/bg1_sm_with_overlay_noise.png) center;',
                //'style'=>'background: #555;',
            )
    );
    ?>
</div>
<div class="col-sm-8 col-sm-offset-2 ">
    <blockquote>
    <h3>This is some Gibberish</h3>
    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
    </blockquote>
    <div class="row">
        <div class="col-md-4">
            <div class="bubble-icon fade-bg "><i class="fa fa-camera-retro fa-lg fade-bg fade-red fade-white-font"></i> </div>
            <h2 >Heading 1</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <div class="bubble-icon fade-bg "><i class="fa fa-beer fa-lg fade-bg fade-red fade-white-font"></i> </div>
            <h2>Heading 2</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <div class="bubble-icon fade-bg "><i class="fa fa-calendar-o fa-lg fade-bg fade-red fade-white-font"></i> </div>
            <h2>Heading 3</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>