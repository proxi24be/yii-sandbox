<?php

class PhpLiteController extends Controller
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
            array('allow', 
                "users"=>array('*'),
                'ips'=>array('192.168.32.*','127.0.0.1'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
                'message'=>'Access Denied.',
            ),
        );
    }

    public function actionAdmin()
    {
        $this->renderPartial("phpliteadmin");
    }

}

?>