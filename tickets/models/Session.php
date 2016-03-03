<?php

namespace app\models;

use Yii;

class Session extends \yii\base\Model {

    private $_session;

    const KEY_ERROR = 'error';

    public function init() {
        $this->_session = \Yii::$app->session;
        $this->_session->open();
        if (!$this->_session->get(self::KEY_ERROR)) {
            $this->clearErrors();
        }
        parent::init();
    }

    public function addError($error) {
        $this->_session->get(self::KEY_ERROR)->append($error);
    }

    public function getErrors() {
        return $this->_session->get(self::KEY_ERROR);
    }

    public function clearErrors() {
        $this->_session->set(self::KEY_ERROR, new \ArrayObject);
    }

}
