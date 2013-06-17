<?php
/**
 * User: TRANN
 * Date: 6/13/13
 * Time: 4:07 PM
 */

class AdmVisitSampleController extends AdminAbstractController {

    public function actionReadAttachedSample($studyID, $visitID = null) {
        // I use classic sql. One can use activerecord but
        // it will complicate the process.
        echo CJSON::encode(AdmVisitSample::read($studyID, $visitID));
    }

}