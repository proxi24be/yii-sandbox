<?php

class VQueue extends MyWebReportsActiveRecord
{
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'WEBREPORTS.V_QUEUE';
    }
    
    public function getDbConnection()
    {
        return self::getWebReportDbConnection();
    }
    
    public static function getReportNotFinished()
    {
        $userID=Yii::app()->user->getID();
        $rows = VQueue::model()->findAll("USER_ID=:userID AND STATUS_ID=1", array(":userID"=>(int)$userID));
        return $rows;
    }
    
    public static function getReportOrderByUser()
    {
        $userID=(int)Yii::app()->user->getID();
        $columns=array("FILENAME","STAMP_CREATE","STATUS","QUEUE_ID","FILEPATH","STAMP_FINISHED");
        $criteria = new CDbCriteria();
        $criteria->select=$columns;
        $criteria->group="FILENAME,STAMP_CREATE,STATUS,QUEUE_ID,FILEPATH,STAMP_FINISHED";
        $criteria->condition="USER_ID=:userID";
        $criteria->params=array(":userID"=>$userID);
        $criteria->order="QUEUE_ID DESC";
        $results=VQueue::model()->findAll($criteria);
        
        return $results;
    }
    
}

?>
