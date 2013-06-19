<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 4:46 PM
 */

namespace application\components\helper;

/**
 * Class DataConverterAbstract
 * @package application\components\helper
 *
 * This class should be extended for every mime/type data that we want to process.
 */
abstract class DataConverterAbstract {

    protected $input;
    protected $data;
    protected $modelName;
    protected $errorMessage;

    public function __construct ($input) {
        $this->input = $input;
        $this->data = array();
        // An implicit conversion is done.
        // So one does not need to call it.
        $this->convert();
    }

    protected abstract function convert ();

    /**
     * @return an array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @return string the name of the model that we want to instanciate.
     */
    public function getModelName() {
        return $this->modelName;
    }

    public function getInstanceModel ()
    {
        $modelName = $this->getModelName();

        switch($modelName) {
            case 'AdmStudy' : return new \AdmStudy();
            case 'AdmVisit' : return new \AdmVisit();
            case 'AdmSample' : return new \AdmSample();
            case 'AdmStudyVisit' : return new \AdmStudyVisit();
            case 'AdmVisitSample' : return new \AdmVisitSample();
            case 'AdmProperty' : return new \AdmProperty();
            case 'AdmGenericValue' : return new \AdmGenericValue();
            case 'AdmHtmlElement' : return new \AdmHtmlElement();
            case 'AdmForm' : return new \AdmForm();
            default : throw new \Exception ('unknown model:'.$modelName);
        }
    }

    public function getErrorMessage ()
    {
        return $this->errorMessage;
    }
}