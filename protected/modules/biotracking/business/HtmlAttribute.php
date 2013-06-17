<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 4:27 PM
 */

namespace application\modules\biotracking\business;


class HtmlAttribute {

    public $id;
    public $name;
    public $class;
    public $ngModel;

    public function getAttributes()
    {
        $array = get_object_vars($this);
        return array_keys($array);
    }

}


