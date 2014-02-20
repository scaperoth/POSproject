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
        'feed_name',
        'feed_url',
        'feed_image',
        array(
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template'=>'{update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl("api/feeds", array("id"=>$data["feed_id"],"command"=>"DELETE"))',
                ),
            ),
        ),
    )
    ,
    'type' => BSHtml::GRID_TYPE_HOVER
));
?>

<fieldset>
    <legend>New News Feed</legend>


    <?php
    $form = $this->beginWidget('BsActiveForm', array(
        'id' => 'Feed-new_Feed-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));
    ?>

    <div class="container">
        <div class=" col-sm-3 col-sm-offset-4">


            <div >
                <?php
                echo $form->textFieldControlGroup($model, 'feed_name', array(
                    'prepend' => BSHtml::icon('comment'),
                ));
                ?>

            </div>

            <div>
                <?php
                echo $form->textFieldControlGroup($model, 'feed_url', array(
                    'prepend' => BSHtml::icon('link')
                ));
                ?>
            </div>

            <div >
                <?php
                echo $form->textFieldControlGroup($model, 'feed_image', array(
                    'prepend' => BSHtml::icon('picture-o')
                ));
                ?>
            </div>


            <?php
            echo BSHtml::submitButton('Submit', array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY
            ));
            ?>
        </div>
    </div>
</fieldset><!-- form -->
<?php $this->endWidget(); ?>