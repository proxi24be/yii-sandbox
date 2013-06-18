<?php
/**
 * User: TRANN
 * Date: 6/13/13
 * Time: 10:30 AM
 */

namespace application\components\helper;
use application\components\helper as helper;

class JsonConverterModel {

    private $objectJson;

    /**
     * @param $input String
     * @throws \Exception
     */
    public function __construct ($input)
    {
        $this->objectJson = json_decode($input);
        if ($this->objectJson === null)
            throw new \Exception ('An issue has occured during the conversion to json object.');
    }

    /**
     * @throws \Exception An exception is throw if the property model is missing.
     * @return an ActiveRecord
     */
    public function getModel ()
    {
        if (isset($this->objectJson->model))
            return helper\AdmCrudFactory::getInstance($this->objectJson->model);
        else
            throw new \Exception ('missing parameter model!');
    }

    /**
     * @throws \Exception
     * @return a matrix
     */
    public function getData ()
    {
        $array = array();
        if (is_array($this->objectJson->data))
        {
            foreach ($this->objectJson->data as $data)
            {
                if (!is_object($data))
                    throw new \Exception ('There is one element in the array that is not an object.');

                $array[] = get_object_vars($data);
            }
        }
        else
        // Should be an object...
        {
            if (!isset($this->objectJson->data))
                throw new \Exception ('property data is null, impossible to save !');
            if (!is_object($this->objectJson->data))
                throw new \Exception ('property data is not an object !');

            $array[] = get_object_vars($this->objectJson->data);
        }
        return $array;
    }
}