<?php

class DefaultController extends AdminAbstractController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionMetaData()
    {
        $this->render('metadata');
    }

}