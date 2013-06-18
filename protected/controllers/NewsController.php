<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 20/01/13
 * Time: 21:40
 */

class NewsController extends Controller {

    /**
     * @return array action filters
     */
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
                'users'=>array('*'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionShow($id=0)
    {
        if (0 == $id)
            $news = AdmNews::model()->desc()->findAll();
        else
            $news = AdmNews::model()->findAll("ID=:ID", array(":ID" => $id));

        $this->render("news", array("news" => $news));
    }

}