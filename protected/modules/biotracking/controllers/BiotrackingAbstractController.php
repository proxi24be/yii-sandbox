<?php

// define the general behavior for Biotracking controller
class BiotrackingAbstractController extends Controller
{
    public $layout = "/layouts/biotrackingLayout";
    protected $_studyID, $_userID, $_studyName;
    // angularJS documentation recommands to add the below line to any returned json data
    protected $_angularJSSecurityJson = ")]}',\n";

    protected function beforeAction($action)
    {
        // petit sucre syntaxique
        $this->_studyID = Yii::app()->user->selectedStudy;
        $this->_userID = Yii::app()->user->id;
        $this->_studyName = "aphinity";
        return parent::beforeAction($action);
    }

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
            array('allow',
                "users" => array('@'),
                'expression' => 'in_array($user->profile, array("IT","INVESTIGATOR","STUDY COORDINATOR","LABORATORY CONTACT"))',
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }
}
