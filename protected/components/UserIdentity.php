<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $record = User::model()->findByAttributes(array('username' => $this->username));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->pass !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $record->user_id;
            $user_permission_id = HasPermissions::model()->findByAttributes(array('usr_id' => $this->_id));

            $user_permission_title = Permissions::model()->findByPk($user_permission_id['permission_id']);

            switch ($user_permission_id['permission_id']) {
                case 1:
                    $this->setState('isUser', true);
                    break;
                case 2:
                    $this->setState('isEmployee', true);
                    break;
                case 3:
                    $this->setState('isUser', true);
                    $this->setState('isEmployee', true);
                    $this->setState('isManager', true);
                    break;
            }

            $this->setState('title', $user_permission_title['permission_type']);
            $this->setState('id', $this->_id);

            $user_store_id = Works::model()->findByAttributes(array('store_emp_id' => $this->_id));

            switch ($user_permission_id['permission_id']) {
                case 1:
                    $this->setState('isUser', true);
                    break;
                case 2:
                    $this->setState('isEmployee', true);
                    break;
                case 3:
                    $this->setState('isUser', true);
                    $this->setState('isEmployee', true);
                    $this->setState('isManager', true);
                    break;
            }
            $this->setState('store_id', $user_store_id['employee_store_id']);
            $this->setState('title', $user_permission_title['permission_type']);

            $this->setState('fname', $record->f_name);
            $this->setState('lname', $record->l_name);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    /**
     * @deprecated since version 1
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.

      public function authenticate()
      {
      $users=array(
      // username => password
      'demo'=>'demo',
      'admin'=>'admin',
      );
      if(!isset($users[$this->username]))
      $this->errorCode=self::ERROR_USERNAME_INVALID;
      elseif($users[$this->username]!==$this->password)
      $this->errorCode=self::ERROR_PASSWORD_INVALID;
      else
      $this->errorCode=self::ERROR_NONE;
      return !$this->errorCode;
      }
     * 
     * 
     */
}
