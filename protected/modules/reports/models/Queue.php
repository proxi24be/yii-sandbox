<?php

class Queue extends MyWebReportsActiveRecord
{
    
    public function rules ()
    {
        return array(
          array("STATUS_ID,FILENAME, REPORT_ID, USER_ID, FORMAT_ID","required"),
            array("FILEPATH","safe"),
        );
    }
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'WEBREPORTS.QUEUE';
    }
    
    public function getDbConnection()
    {
        return self::getWebReportDbConnection();
    }
    
    public static function createRecord($model)
    {
        $newQueue=new Queue();
//        $newQueue->QUEUE_ID=new CDbExpression("SEQ_QUEUE_ID.NEXTVAL");
        $newQueue->STATUS_ID=1;
        $newQueue->FILENAME=$model->FILENAME . ".$model->FORMAT";
        $newQueue->REPORT_ID=$model->attributes["REPORT_ID"];
        
        if ($model->FORMAT=="PDF")
                $newQueue->FORMAT_ID=1;
        else if ($model->FORMAT=="XLS")
                $newQueue->FORMAT_ID=2;
        else if ($model->FORMAT=="HTML")
                $newQueue->FORMAT_ID=3;
        else
            ;
        $newQueue->USER_ID=Yii::app()->user->getID();
        if (!$newQueue->save())
            throw new CHttpException("Report issue : your order can not be completed");
        
        return $newQueue->primaryKey;
    }
    
    public static function updateStampFinished(array $rows)
    {
        $timeOut=60*15; // 15 minutes de timeout
        foreach ($rows as $row)
        {
            $stampCreate=strtotime($row["STAMP_CREATE"]);
            $queueID= $row["QUEUE_ID"];
            // si le timeout est dépassé et que le fichier n'a toujours pas été cré
            if ($stampCreate <(time()-$timeOut) && !file_exists($row["FILEPATH"]) ) 
                    Queue::updateQueueStatus(3,$queueID);
            else
            {
                if (file_exists($row["FILEPATH"]))
                    Queue::updateQueueStatus(2,$queueID);
            }
        }
    }
    
    public static function updateQueueStatus ($statusID,$queueID)
    {
        $queue=Queue::model()->findByPK($queueID);
        if ($queue != null)
        {
            $queue->STAMP_FINISHED= new CDbExpression("SYSDATE");
            $queue->STATUS_ID=$statusID; 
            $queue->save();
        }
    }
    
}

?>
