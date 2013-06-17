<?php
/**
 * User: TRANN
 * Date: 6/10/13
 * Time: 1:11 PM
 */

class AdmStudyVisitController extends AdminAbstractController {

    public function actionShowVisit($studyID = null)
    {
        $valueToReturn =  array();
        try
        {
            if(isset($studyID))
            {
                $study = AdmStudy::model()->findByPk($studyID);
                if ($study == null)
                    throw new Exception("Study unknown : $studyID");

                $valueToReturn = $study->visits;
            }
        }
        catch (Exception $e)
        {
            //Log the issue or/and send email to admin.
        }
        echo CJSON::encode($valueToReturn);
    }

    public function actionShowFreeVisit ($studyID)
    {
        $valueToReturn = array();
        try
        {
            // I could have used the MANY_MANY relationship feature
            // However It is a little too 'verbeux'
            // So I use a query instead.
            $valueToReturn = AdmVisit::showFreeVisit($studyID);
        }
        catch (Exception $e)
        {
            // Log the message or/and send email to admin.
        }
        echo CJSON::encode($valueToReturn);
    }

}