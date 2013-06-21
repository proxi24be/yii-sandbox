<?php
/**
 * User: TRANN
 * Date: 6/13/13
 * Time: 12:51 PM
 */

namespace application\components\helper;
use application\components\helper as helper;

class GenericWrapperModel {

    private $_errorMessage;


    public function create (helper\HttpParamAbstract $httpParam)
    {
       try
       {
           $matrix = $httpParam->getData();
           // An issue performance will rise up if there are too many records to create.
           // In that situation it is better to switch from activerecord to pure sql + transaction.
           foreach ($matrix as $params)
           {
               $activeRecord = $httpParam->getCActiveRecord();
               // Mass assignation.
               $activeRecord->attributes = $params;

               // A validation error has occured.
               // A required attribute is missing.
               if (!$activeRecord->save())
                   throw new \Exception(print_r($activeRecord->getErrors(), true));
           }
           return true;
       }
       catch (Exception $e)
       {
           $this->_errorMessage = $e->getMessage();
           return false;
       }
    }

    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }
}