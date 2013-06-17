<?php
/**
 * User: TRANN
 * Date: 6/12/13
 * Time: 3:11 PM
 */

namespace application\components\helper;

class AdmCrudFactory {

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
            default : throw new Exception ('unknown model:'.$modelName);
        }
    }

}