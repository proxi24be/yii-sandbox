<?php

Yii::import('application.controllers.*');

require_once('AdminAbstractController.php');

class DefaultController extends AdminAbstractController
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow only authenticated to perform 'index' and 'view' actions
                'users'=>array('@'),
                'ips'=>array('192.168.32.*','127.0.0.1'),
                'expression'=>'$user->title=="IT"',
            ),
            
            array('deny',  // deny all users
                'users'=>array('*'),
                'message'=>'Access Denied.',
            ),
        );
    }

    public function actionIndex()
    {
         $this->render("index");
    }
}