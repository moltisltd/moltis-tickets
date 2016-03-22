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
            $this->clearErrors();
        }
        if (!$this->_session->get(self::KEY_SUCCESS)) {
            $this->clearSuccesses();
        }
        parent::init();
    }

    public function addError($message) {
        $this->_session->get(self::KEY_ERROR)->append($message);
    }

    public function getErrors() {
        return $this->_session->get(self::KEY_ERROR);
    }

    public function clearErrors() {
        $this->_session->set(self::KEY_ERROR, new \ArrayObject);
    }

    public function addSuccess($message) {
        $this->_session->get(self::KEY_SUCCESS)->append($message);
    }

    public function getSuccesses() {
        return $this->_session->get(self::KEY_SUCCESS);
    }

    public function clearSuccesses() {
        $this->_session->set(self::KEY_SUCCESS, new \ArrayObject);
    }

}
