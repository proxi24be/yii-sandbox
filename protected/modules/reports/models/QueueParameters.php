<?php

class QueueParameters extends MyWebReportsActiveRecord
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
        return 'WEBREPORTS.QUEUE_PARAMETERS';
    }
    
    public function getDbConnection()
    {
        return self::getWebReportDbConnection();
    }
    
    /** 
     *Assumption : RANDO_SITE_ID ou CURRENT_SITE_ID est un array 
     * 
     * @param type $model 
     */
    public static function insertAllParameters($model)
    {
        if ( is_array($model->attributes["CURRENT_SITE_ID"]))
        {
            if (QueueParameters::checkIfEmptyOrAllSelected($model->attributes["CURRENT_SITE_ID"]))
            {
                $centres = QueueParameters::getCentresByCountry($model->attributes["REGION_ID"]);
                $model->CURRENT_SITE_ID=$centres["CURRENT_SITE_ID"];
            }
        }

        else
        {
            if ( is_array($model->attributes["RANDO_SITE_ID"]))
            {
                if (QueueParameters::checkIfEmptyOrAllSelected($model->attributes["RANDO_SITE_ID"]))
                {
                    $centres = QueueParameters::getCentresByCountry($model->attributes["REGION_ID"]);
                    $model->RANDO_SITE_ID=$centres["RANDO_SITE_ID"];
                }
            }
        }
        
        QueueParameters::insertParameter($model, "REGION_ID");
        QueueParameters::insertParameter($model, "CURRENT_SITE_ID");
        QueueParameters::insertParameter($model, "RANDO_SITE_ID");
        QueueParameters::insertParameter($model, "PATIENT_POSITION_ID");
        QueueParameters::insertParameter($model, "SCREENING_PATIENT_ID");
    }
    
    public static function insertParameter($model,$paramName)
    {
        $doubleKey=$model->getDoubleKeyParams();
        $paramID=$doubleKey->getValue($paramName);
        $array=$model->attributes["$paramName"];
        if (count ($array)>0)
        {
            foreach ($array as $value)
            {
                if (strtoupper($value) !== 'ALL')
                {
                    $queueParameter = new QueueParameters;
                    $queueParameter->QUEUE_ID=$model->QUEUE_ID;
                    $queueParameter->PARAMETER_ID=$paramID;
                    $queueParameter->VALUE=$value;
                    if (!$queueParameter->save())
                        throw new CHttpException("An unexpected did occur the system was not able to generate your report.");
                }
            }
        }
    }
    
    public static function checkIfEmptyOrAllSelected(array $array)
    {
        if (count($array)==0) // quand vide
            return true;
        else
        {
            if (strtoupper($array[0])=="ALL") // quand l'utilisateur a selectionne all
                return true;
            else 
                return false;
        }
    }
    
    
    /**
     *
     * @param type $model
     * @return type array ('CURRENT_SITE_ID' => array(), 'RANDO_SITE_ID'=> array())
     */
    public static function getCentresByCountry (array $countries)
    {
        $centres=array();
        $conditionIN ="";
        $criteria= new CDbCriteria();
        $criteria->select = array("CURRENT_SITE_ID","RANDO_SITE_ID");
        $criteria->group="CURRENT_SITE_ID,RANDO_SITE_ID";
        $criteria->condition = "USER_ID=:userID";
        if (count ($countries) >0)
        {
//            foreach ($countries as $country)
//                 $conditionIN= $conditionIN . "$country,";
            
            $conditionIN="(" .  substr($conditionIN, 0, -1) . ")";
            $criteria->params=array(":condition"=>$conditionIN,":userID"=>(int)Yii::app()->user->getID());
            $criteria->addInCondition("REGION_ID", $countries);
            $rows=VUserGroupPatient::model()->findAll($criteria);
            foreach ($rows as $row)
            {
                $centres["CURRENT_SITE_ID"][]=$row["CURRENT_SITE_ID"];
                $centres["RANDO_SITE_ID"][]=$row["RANDO_SITE_ID"];
            }
        }
        return $centres;
    }
    
}

?>
