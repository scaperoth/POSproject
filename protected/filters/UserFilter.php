<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManagerFilter
 *
 * @author scaperoth
 */
class UserFilter extends CFilter {
    
    protected function preFilter($filterChain) {
        // logic being applied before the action is executed
        if (Yii::app()->user->isUser()) {
                return true;
        }
        else{
            $this->deny();
            return false; // false if the action should not be executed
        }
    }
    
    private function deny(){
        Yii::app()->user->setFlash('danger','No account found. Please create an account to continue.');
        Yii::app()->getController()->redirect(array('/site/'));
    }
}

?>
