<?php
/**
 * User: TRANN
 * Date: 6/3/13
 * Time: 3:06 PM
 */

class AdminAbstractController extends Controller {

    public $layout="//layouts/AdminLayout";

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
                "users"=>array('@'),
                'ips'=>array('192.168.32.*','127.0.0.1'),
                'expression'=>'$user->profile=="IT"',
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
                'message'=>'Access Denied.',
            ),
        );
    }

}