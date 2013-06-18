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
            $activeRecord = helper\AdmCrudFactory::getInstance($model);
            // We do not want to use the parameter model with the AR.
            unset($_GET['model']);
            $data = $activeRecord->findAllByAttributes($_GET);
            echo CJSON::encode($data);
        }
        catch (\Exception $e)
        {
            echo CJSON::encode(RequestMessage::$FAILED);
        }
    }

    public function actionCreate ()
    {
        try
        {
            $jsonConverterModel = new helper\JsonConverterModel(file_get_contents('php://input'));
            $genericWrapperModel = new helper\GenericWrapperModel();
            if ($genericWrapperModel->create($jsonConverterModel))
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