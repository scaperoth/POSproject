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
        'playlist_name',
        array(
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template'=>'{update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl("api/playlists", array("id"=>$data["playlist_id"],"command"=>"DELETE"))',
                ),
            ),
        ),
    )
    ,
    'type' => BSHtml::GRID_TYPE_HOVER
));
?>
<fieldset>
    <legend>New Playlist</legend>


    <?php
    $form = $this->beginWidget('BsActiveForm', array(
        'id' => 'Playlist-new_Playlist-form',
        'enableAjaxValidation' => true,
            'enableClientValidation' => true,
    ));
    ?>
    <div class="container">
        <div class=" col-sm-3 col-sm-offset-4">


            <div >
                <?php
                echo $form->textFieldControlGroup($model, 'playlist_name', array(
                    'prepend' => BSHtml::icon('list')
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