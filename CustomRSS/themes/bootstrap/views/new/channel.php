<?php
/* @var $this FeedController */
/* @var $model Feed */
/* @var $form CActiveForm */
?>
<?php
$gridDataProvider = $model->search();

$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider,
    'filter'=>$model,
    'template'=>"{items}",
    'columns' => array(
        'channel_name',
        array(
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template'=>'{update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl("api/channels", array("id"=>$data["channel_id"],"command"=>"DELETE"))',
                ),
            ),
        ),
    )
    ,
    'type' => BSHtml::GRID_TYPE_HOVER
));
?>
<fieldset>
    <legend>New Channel</legend>


    <?php
    $form = $this->beginWidget('BsActiveForm', array(
        'id' => 'Channel-new_Channel-form',
        'enableAjaxValidation' => true,
            'enableClientValidation' => true,
    ));
    ?>
    <div class="container">
        <div class=" col-sm-3 col-sm-offset-4">


            <div >
                <?php
                echo $form->textFieldControlGroup($model, 'channel_name', array(
                    'prepend' => BSHtml::icon('laptop')
                ));
                ?>

            </div>

            <?php
            echo BSHtml::submitButton('Submit', array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY
            ));
            ?>
        </div>
</fieldset><!-- form -->
<?php $this->endWidget(); ?>