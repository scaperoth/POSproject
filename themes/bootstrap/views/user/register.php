<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'Register',
   )
?>
<fieldset>
    
    <?php
    $form = $this->beginWidget('BsActiveForm', array(
        'id' => 'Register-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ));
    ?>
    <div class="container">
        <div class=" col-sm-3 col-sm-offset-4">
            <legend><h1>Register</h1></legend>
            <?php
            echo $form->textFieldControlGroup($model, 'username', array(
                'placeholder' => 'Username',
                'prepend' => BSHTML::icon('user'),
            ));
            ?>
            
            
            <?php
            echo $form->textFieldControlGroup($model, 'f_name', array(
                'placeholder' => 'Firstname',
                'prepend' => BSHTML::icon('user'),
            ));
            ?>
            
            <?php
            echo $form->textFieldControlGroup($model, 'l_name', array(
                'placeholder' => 'Lastname',
                'prepend' => BSHTML::icon('user'),
            ));
            ?>

            <?php
            echo $form->passwordFieldControlGroup($model, 'pass', array(
                'placeholder' => 'Password',
                'prepend' => BSHTML::icon('lock'),
            ));
            ?>


            <?php
            echo BSHtml::submitButton('Submit', array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY
            ));
            ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</fieldset>