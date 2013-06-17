<?php
/**
 * User: TRANN
 * Date: 6/12/13
 * Time: 3:08 PM
 */

Yii::import('application.modules.biotracking.models.*');

use application\components\helper as helper ;

class AdmCRUDController extends AdminAbstractController {

    /**
     * @param $model
     * @param null $id
     *
     * Thanks to YII if $model parameter is not sent,
     * a CHTTPException is automatically raised.
     */
    public function actionRead ($model, $id = null)
    {
        try
        {
            $activeRecord = helper\AdmCrudFactory::getInstance($model);
            if (isset($id))
                $data = $activeRecord->findByPk($id);
            else
                $data = $activeRecord->findAll();

            echo CJSON::encode($data);
        }
        catch (Exception $e)
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
        catch (Exception $e)
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
            throw new Exception ('not yet implemented');
        }
        catch (Exception $e)
        {
            $request = RequestMessage::$FAILED;
            Yii::trace($e->getMessage(), 'app.administration.admCRUD');
        }
        echo CJSON::encode($request);
    }
}