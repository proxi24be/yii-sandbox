<?php

use \application\components\helper as helper;

class DefaultController extends AdminAbstractController
{
    public function actionIndex()
    {
        // At this point it does not matter which child class
        // of HttpParamAbstract has been instantied.
        $httpParam = new helper\HttpJsonParam();
        $httpParam = json_encode($httpParam);
        $this->render('index', array('httpParam' => $httpParam));
    }

    public function actionMetaData()
    {
        $this->render('metadata');
    }

}