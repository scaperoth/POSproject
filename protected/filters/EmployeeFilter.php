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
class EmployeeFilter extends CFilter {
    
    protected function preFilter($filterChain) {
        // logic being applied before the action is executed
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->user->isEmployee) {
                return true;
            }
        }
        else{
            Yii::app()->user->setFlash('danger','Permission Denied.');
            Yii::app()->getController()->redirect(array('/site/'));
            return false; // false if the action should not be executed
        }
    }
}

?>
