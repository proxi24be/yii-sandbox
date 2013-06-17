<?php

use application\modules\biotracking\business\StudySampleDetailsFormModel;
use application\modules\biotracking\business as MyBusiness;

require_once("BiotrackingAbstractController.php");
require_once("custom/MyGenericValue.php");
require_once("custom/MySampleFormAttributes.php");


class SampleFormController extends BiotrackingAbstractController
{
    /**
     * @throws CHttpException
     * @return An array containing JSON objects.
     */
    public function actionGetAllAttributesForSampleForm()
    {
        if (count($_GET) == 0)
            throw new CHttpException(400, 'hacking ???');
        try
        {
            $studySampleDetailsForm = new StudySampleDetailsFormModel();

            $get = MyMap::fetchAttributes(array_keys($studySampleDetailsForm->getAttributes()), $_GET);
            $get['STUDY_ID']  = $this->_studyID;
            $get['studyName'] = $this->_studyName;
            $studySampleDetailsForm->attributes = $get;

            echo CJSON::encode($studySampleDetailsForm->getBusinessAttributes());
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), 'error', 'app.biotracking.sampleForm');
        }
    }

    public function actionSaveSampleForm()
    {
        $result = new stdClass();
        try
        {
            $jsonObject = json_decode(file_get_contents('php://input'));
            $jsonObject->USER_ID = $this->_userID;
            $jsonObject->STUDY_ID = $this->_studyID;
            $jsonObject->studyName = $this->_studyName;

            $factory = new MyBusiness\FactorySample($jsonObject);
            $sample = $factory->getSampleInstance();
            $sample->createSampleInformation();
            $result->status = 'success';
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), "error", "app.biotracking.biosample");
            Yii::trace($e->getMessage(), "app.biotracking.biosample");
            $result->status = 'failed';
        }
        echo CJSON::encode($result);
    }
}

