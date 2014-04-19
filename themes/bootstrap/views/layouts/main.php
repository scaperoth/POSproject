<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <?php
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->theme->baseUrl;

        /**
         * StyleSHeets
         */
        $cs->registerCssFile('http://fonts.googleapis.com/css?family=Abril+Fatface|Open+Sans:300italic,400italic,400,300'); //google fonts
        $cs->registerCssFile($themePath . '/assets/css/bootstrap.min.css');
        $cs->registerCssFile('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
        $cs->registerCssFile('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css');
        //$cs->registerCssFile($themePath . '/assets/css/bootstrap-theme.min.css');
        $cs->registerCssFile($themePath . '/assets/fractionslider/fractionslider.css');
        $cs->registerCssFile($themePath . '/assets/css/style.css');
        $cs->registerCssFile($themePath . '/assets/font-awesome-4.0.3/css/font-awesome.min.css');


        /**
         * JavaScripts
         */
        $cs->registerScriptFile($themePath . '/assets/js/jquery-migrate-1.2.1.min.js', CClientScript::POS_END);
        $cs->registerCoreScript('jquery', CClientScript::POS_BEGIN);
        $cs->registerCoreScript('jquery.ui', CClientScript::POS_BEGIN);

        $cs->registerScriptFile($themePath . '/assets/js/bootstrap.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/assets/js/stellar/jquery.stellar.min.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($themePath . '/assets/fractionslider/jquery.fractionslider.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/assets/nicescroll/jquery.nicescroll.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/assets/js/script.js', CClientScript::POS_END);
        $cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
        ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php
        echo $themePath . '/assets/js/html5shiv.js';
        ?>"></script>
            <script src="<?php
        echo $themePath . '/assets/js/respond.min.js';
        ?>"></script>
        <![endif]-->

    </head>

    <body >

        <?php
        $this->widget('bootstrap.widgets.BsNavbar', array(
            'collapse' => true,
            'color' => 'inverse',
            'brandLabel' => BSHtml::icon('home fw') . ' ' . CHtml::encode(Yii::app()->name),
            'brandUrl' => Yii::app()->homeUrl,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.BsNav',
                    'type' => 'navbar',
                    'activateParents' => true,
                    'htmlOptions' => array(
                        'pull' => BSHtml::PULL_RIGHT,
                    ),
                    'items' => array(
                        array(
                            'label' => 'Some Menu Item',
                            //'icon' => 'dashboard fw',
                            'url' => array('#')
                        ),
                        array('label' => 'Admin', 'url' => array('manager/dashboard'), 'items' => array(
                                array('label' => 'Manager Dasboard', 'url' => array('manager/dashboard')),
                                array('label' => 'Human Resources', 'url' => array('manager/hr')),
                                array('label' => 'Inventory', 'url' => array('manager/inventory')),
                            ), 'visible' => Yii::app()->user->isManager()),
                        array('label' => 'Employee', 'url' => array('employee/'), 'items' => array(
                                array('label' => 'Employee Dashbaord', 'url' => array('employee/employee')),
                                array('label' => 'Checkout', 'url' => array('employee/checkout')),
                            ), 'visible' => Yii::app()->user->isManager()),
                        BSHtml::navbarMenuDivider(array('class' => 'hidden-xs')),
                        array(
                            'label' => 'Sign In',
                            'url' => array(
                                '/site/login'
                            ),
                            'icon' => 'sign-in fw',
                            'visible' => Yii::app()->user->isGuest
                        ),
                        array(
                            'label' => 'Register',
                            'url' => array(
                                '#'
                            ),
                            'icon' => 'edit fw',
                            'visible' => Yii::app()->user->isGuest
                        ),
                        array(
                            'label' => 'Sign Out',
                            'url' => array(
                                '/site/logout'
                            ),
                            'icon' => 'power-off fw',
                            'iconColor' => 'red',
                            'visible' => !Yii::app()->user->isGuest
                        ),
                        BSHtml::navbarMenuDivider(array('class' => 'hidden-xs')),
                    ),
                )
            )
        ));
        ?>
        <div class="container-fluid bs-docs-container"  id="page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                /**
                  $this->widget('bootstrap.widgets.BsBreadcrumb', array(
                  'links' => $this->breadcrumbs,
                  ));*
                 */
                ?><!-- breadcrumbs -->

            <?php endif ?>
            <?php
            $flashMessages = Yii::app()->user->getFlashes();
            if ($flashMessages) {
                echo '<ul class="flashes">';
                foreach ($flashMessages as $key => $message) {
                    echo '<li><div class="alert alert-' . $key . '">' . $message . "</div></li>\n";
                }
                echo '</ul>';
            }
            ?>
            <?php echo $content; ?>

            <div class="clearfix"></div>



        </div><!-- page -->
        <div id="footer">
            <div class="container-fluid">

                <hr class="" style="border-color:#bbb;"></hr>
                <div class="container">
                </div>
            </div>

        </div> <!--footer -->
    </body>
    <script>
        $(document).ready(
                function() {
                    $("html").niceScroll({
                        cursorwidth: '8px',
                        cursorborder: 'none',
                        overflow: 'hidden',
                        cursoropacitymin: 1,
                        scrollspeed: 70,
                    });
                    $('.slider').fractionSlider({
                        'fullWidth': true,
                        'controls': true,
                        'responsive': true,
                        'dimensions': '1700, 300',
                        'slideTransitionSpeed': 0,
                        'increase': true,
                    });
                    $.stellar({
                        horizontalScrolling: false,
                        verticalScrolling: true,
                        responsive: true,
                        positionProperty: 'position',
                    });


                }

        );
    </script>
    <?php
    Yii::app()->clientScript->registerScript(
            'myHideEffect', '$(".alert").animate({opacity: 0.20}, 6000).fadeOut("slow");', CClientScript::POS_READY
    );
    ?>
</html>
