<?php

class BrEASTFeedController extends Controller
{
    public $layout="/layouts/breastfeed";
    
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
    
    public function actionIndex()
    {
         $this->render("index");
    }
    
    
    public function actionNewFeed()
    {
        $this->render("newfeed");
    }
    
    public function actionAddNewFeed()
    {
        if (isset($_POST["newfeed"]) && !empty($_POST["newfeed"]))
        {
            $newsFeed=new NewsFeed;
            $newsFeed->HTMLTEXT=$_POST["newfeed"];
            $newsFeed->TIMESTAMP=new CDbExpression("SYSDATE");
            if ($newsFeed->save())
                    echo "ok";
            else
                echo "nok";
        }
        else
            echo "nok";
    }
    
    public function actionDisplayAllFeed()
    {
        $cdbCriteria = new CDbCriteria();
        $cdbCriteria->order="ID DESC";
        $duration=60*60*24*7;
        $dependency = new CDbCacheDependency("SELECT MAX(TIMESTAMP) FROM BREAST.NEWSFEED");
        $model = NewsFeed::model()->cache($duration, $dependency)->findAll($cdbCriteria);
        Yii::log("dependency:".$dependency->getDependentData());
        $this->render("listAllFeed",array("model"=>$model));
    }
    
}