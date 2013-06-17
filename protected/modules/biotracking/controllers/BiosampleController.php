<?php

use application\modules\biotracking\business as StudyBusiness;

require_once("BiotrackingAbstractController.php");
require_once("abstract/Biotracking.php");


/**
 * Class BiosampleController
 */
class BiosampleController extends BiotrackingAbstractController
{
    public function actionNewSample($form = null)
    {
        try
        {
            $this->displayForm($form);
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), 'error', 'app.biotracking.biosample');
        }

    }

    /**
     * This action performs two things:
     *   1) save some specific attributes (if it is required by the business flow)
     *   2) Sending back a response to the client.
     *
     * @throws CHttpException
     * @throws Exception
     * @return Object json
     */
    public function actionValidationNewSample()
    {
        $result = array();
        $result["status"] = "failed";

        if (0 == count($_POST))
            throw new CHttpException(400);
        try
        {
            $newSampleForm = new StudyBusiness\NewSampleFormModel(strtolower($this->_studyName));
            $attributesEnteredByUser = MyMap::fetchAttributes(array_keys($newSampleForm->getAttributes()), $_POST);
            $attributesEnteredByUser['STUDY_ID'] = $this->_studyID;
            $attributesEnteredByUser['studyName'] = $this->_studyName;
            $attributesEnteredByUser['userID'] = $this->_userID;
            // Mass assignation.
            $newSampleForm->attributes = $attributesEnteredByUser;

            // Check if all the required attributes are valid.
            if ($newSampleForm->validate())
                $newSampleForm->executeBusiness();
            else
                throw new Exception(print_r($newSampleForm->getErrors(), true));

            $result["status"] = "success";
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), "error", "app.biotracking.biosample.actionValidationNewSample");
            $result['status'] == 'failed';
        }
        echo CJSON::encode($result);
    }

    private function displayForm($form)
    {
        if (!isset($form))
        {
            $additionalParams = array();
            $additionalParams["studyName"] = $this->_studyName;
            $this->render("new_sample", $additionalParams);
        }
        else
        {
            if ('newsampleform' == $form)
            {
                include_once("custom/NewSampleLogicHtml.php");
                $model = NewSampleLogicHtml::factory("aphinity");
                $this->renderPartial("new_sample_form", array("model" => $model));
            }
            else if ('sampledetailsform' == $form)
            {
                include_once("custom/SampleDetailsLogicHtml.php");
                $model = SampleDetailsLogicHtml::allStudy();
                $this->renderPartial("sample_details_form", array("model" => $model));
            }
            else
                throw new MyException('Unknown requested form');
        }
    }
}

