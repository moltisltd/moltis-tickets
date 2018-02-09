<?php

namespace app\models;

use Yii;

class Session extends \yii\base\Model {

    private $_session;

    const KEY_ERROR = 'error';
    const KEY_SUCCESS = 'success';

    public function init() {
        $this->_session = \Yii::$app->session;
        $this->_session->open();
        if (!$this->_session->get(self::KEY_ERROR)) {
            $this->clearErrorMessages();
        }
        if (!$this->_session->get(self::KEY_SUCCESS)) {
            $this->clearSuccessMessages();
        }
        parent::init();
    }

    public function addErrorMessage($message) {
        $this->_session->get(self::KEY_ERROR)->append($message);
    }

    public function getErrorMessages($attribute = null) {
        return $this->_session->get(self::KEY_ERROR);
    }

    public function clearErrorMessages() {
        $this->_session->set(self::KEY_ERROR, new \ArrayObject);
    }

    public function addSuccessMessage($message) {
        $this->_session->get(self::KEY_SUCCESS)->append($message);
    }

    public function getSuccessMessages() {
        return $this->_session->get(self::KEY_SUCCESS);
    }

    public function clearSuccessMessages() {
        $this->_session->set(self::KEY_SUCCESS, new \ArrayObject);
    }

}
