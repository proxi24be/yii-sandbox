<?php
/**
 * User: TRANN
 * Date: 6/12/13
 * Time: 3:08 PM
 */

Yii::import('application.modules.biotracking.models.*');
use application\components\helper as helper ;

class AdmCRUDController extends AdminAbstractController {

    public function actionRead ($model)
    {
        try
        {
            $httpParam = new helper\HttpFormParam($_GET);
            $activeRecord = $httpParam->getCActiveRecord();
            if (!isset($activeRecord))
                throw new Exception('instance object does not exist');
            // We do not want to use the parameter model with the AR.
            $data = $activeRecord->findAllByAttributes($httpParam->getData());
            echo CJSON::encode($data);
        }
        catch (\Exception $e)
        {
            Yii::trace($e->getMessage(), 'app.administration.AdmCRUD');
            echo CJSON::encode(RequestMessage::$FAILED);
        }
    }

    public function actionCreate ()
    {
        try
        {
            $genericWrapperModel = new helper\GenericWrapperModel();
            if ($genericWrapperModel->create(new helper\HttpJsonParam(file_get_contents('php://input'))));
                $request = RequestMessage::$SUCCESS;
        }
        catch (\Exception $e)
        {
            $request = RequestMessage::$FAILED;
            Yii::trace($e->getMessage(), 'app.administration.admCRUD');
        }

        echo CJSON::encode($request);
    }

    public function actionUpdate ()
    {
        try
        {
            throw new \Exception ('not yet implemented');
        }
        catch (\Exception $e)
        {
            $request = RequestMessage::$FAILED;
            Yii::trace($e->getMessage(), 'app.administration.admCRUD');
        }
        echo CJSON::encode($request);
    }
}