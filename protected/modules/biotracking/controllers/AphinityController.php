<?php

/**
 *   Business specific to Aphinity
 */

require_once("BiotrackingAbstractController.php");
require_once("abstract/Biotracking.php");
require_once ("custom/aphinity/MySampleNumber.php");
require_once ("custom/aphinity/MyKitNumber.php");

class AphinityController extends BiotrackingAbstractController
{
    public function actionGetSampleNumber()
    {
        $sampleNumber = new MySampleNumber();
        echo CJSON::encode($sampleNumber->getAllSampleNumber());

    }

    public function actionGetSampleKitID()
    {
        try
        {
            $kitNumber = new MyKitNumber();
            echo CJSON::encode($kitNumber->findAllKitNumberOfUser($this->_userID));
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), 'error', 'app.biotracking.aphinity');
        }

    }

}
