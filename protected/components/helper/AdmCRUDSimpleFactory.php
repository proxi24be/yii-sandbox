<?php
/**
 * User: TRANN
 * Date: 6/19/13
 * Time: 2:31 PM
 */

namespace application\components\helper;


class AdmCRUDSimpleFactory {

    public static function getInstance ($modelName)
    {
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
            case 'AdmStudyForm' : return new \AdmStudyForm();
            default : throw new \Exception ('unknown model:'.$modelName);
        }
    }

}