<?php

class NewController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    public function actionFeed() {
        $keyword = "Feed";
        $model = new Feed;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === "$keyword-new_$keyword-form") {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST[$keyword])) {
            $model->attributes = $_POST[$keyword];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                try {
                    $model->save();
                    Yii::app()->user->setFlash('success', "$keyword saved");
                    $this->redirect(strtolower($keyword));
                } catch (CDbException $e) {
                    if ($e->getCode() == 23000)
                        Yii::app()->user->setFlash('danger', "Record already exists. $keyword not saved.");
                        $this->redirect(strtolower($keyword));
                }
            }
        }
        // display the login form
        $this->render(strtolower($keyword), array('model' => $model));
    }
    
    public function actionChannel() {
        $keyword = "Channel";
        $model = new Channel;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === "$keyword-new_$keyword-form") {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST[$keyword])) {
            $model->attributes = $_POST[$keyword];
            // validate user input and redirect to the previous page if valid
             if ($model->validate()) {
                try {
                    $model->save();
                    Yii::app()->user->setFlash('success', "$keyword saved");
                    $this->redirect(strtolower($keyword));
                } catch (CDbException $e) {
                    if ($e->getCode() == 23000)
                        Yii::app()->user->setFlash('danger', "Record already exists. $keyword not saved.");
                        $this->redirect(strtolower($keyword));
                }
            }
        }
        // display the login form
        $this->render(strtolower($keyword), array('model' => $model));
    }
    
    public function actionPlaylist() {
        $keyword = "Playlist";
        $model = new Playlist;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === "$keyword-new_$keyword-form") {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST[$keyword])) {
            $model->attributes = $_POST[$keyword];
            // validate user input and redirect to the previous page if valid
             if ($model->validate()) {
                try {
                    $model->save();
                    Yii::app()->user->setFlash('success', "$keyword saved");
                    $this->redirect(strtolower($keyword));
                } catch (CDbException $e) {
                    if ($e->getCode() == 23000)
                        Yii::app()->user->setFlash('danger', "Record already exists. $keyword not saved.");
                        $this->redirect(strtolower($keyword));
                }
            }
        }
        // display the login form
        $this->render(strtolower($keyword), array('model' => $model));
    }
    
    public function actionUpdate(){
            
        
    }

}