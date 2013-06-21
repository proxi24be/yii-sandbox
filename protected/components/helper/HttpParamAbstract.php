<?php
/**
 * User: TRANN
 * Date: 6/21/13
 * Time: 11:14 AM
 */

namespace application\components\helper;

/**
 * Class HttpParamAbstract
 * @package application\components\helper
 *
 * This class has for aim to give a json object to the client side.
 * It defines what parameters are expected when sending a request of type CRUD.
 *
 * @param $model a string is expected.
 * @param $data a map is expected or an array of map in case of multiple create/update/delete.
 */

abstract class  HttpParamAbstract {

    public $model;
    public $data = array();
    protected $input;

    public function __construct ($input = null) {
        $this->input = $input;
        // An implicit conversion is done.
        // So one does not need to call it.
        $this->convert();
    }

    public function setInput ($input) {
        $this->input = $input;
    }

    public abstract function convert ();

    public function getData () {
        return $this->data;
    }

    public function getModelName () {
        return $this->model;
    }

}
