<?php
/**
 * User: TRANN
 * Date: 6/13/13
 * Time: 12:51 PM
 */

namespace application\components\helper;
use application\components\helper as helper;

class GenericWrapperModel {

    public function create (helper\JsonConverterModel $jsonConverterModel)
    {
        $matrix = $jsonConverterModel->getData();
        // An issue performance will rise up if there are too many records to create.
        // In that situation it is better to switch from activerecord to pure sql + transaction.
        foreach ($matrix as $array)
        {
            $activeRecord = $jsonConverterModel->getModel();
            $attributes = $activeRecord->attributes;
            foreach ($array as $key => $value)
            {
                // One need to check if the parameter
                // match an existing attribute of the record.
                // Otherwise a validation error could rise up.
                if (array_key_exists($key, $attributes))
                    $activeRecord->$key = $value;
            }
            // A validation error has occured.
            // A required attribute is missing.
            if (!$activeRecord->save())
                throw new \Exception(print_r($activeRecord->getErrors(), true));
        }
        return true;
    }
}