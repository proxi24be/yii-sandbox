<?php
/**
 * User: TRANN
 * Date: 3/19/13
 * Time: 1:47 PM
 */

namespace application\modules\biotracking\business;

class AttributeToCollect
{

    private $_data;
    private $_attribute;

    public function __construct($attribute) {
        $this->_data = array();
        $this->_attribute = $attribute;
        $this->_data[$this->_attribute] = array();
    }

    public function getAttributeName() {
        return $this->_attribute;
    }

    public function addColumnNameInDb($column) {
        $this->_data[$this->_attribute]['column'] = $column;
    }

    public function getColumnNameInDb() {
        return $this->_data[$this->_attribute]['column'];
    }

}