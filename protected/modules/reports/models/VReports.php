<?php

class VReports extends CActiveRecord
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
        return 'WEBREPORTS.V_REPORTS';
    }
    
    
    public static function getListParams ($reportID,$model)
    {
        $connection=Yii::app()->db;   
        $sql="select report_id, server_id, exec_file, parameter_id, parameter, order_by from webreports.v_reports 
            where report_id = :reportID and breast_role_id in (:roleBrEASTID) 
            group by report_id, server_id, exec_file, parameter_id, parameter, order_by order by order_by";
        $command=$connection->createCommand($sql);
        // replace the placeholder ":username" with the actual username value
        $command->bindParam(":reportID",$reportID,PDO::PARAM_STR);
        // replace the placeholder ":email" with the actual email value
        $command->bindParam(":roleBrEASTID",VReports::getConditionRoleBrEASTID($model),PDO::PARAM_STR);
        
        return VReports::createParams($command->queryAll());
    }
    
    public static function getConditionRoleBrEASTID($model)
    {
        $roleBrEASTID="";
        foreach ($model as $row)
            $roleBrEASTID=$roleBrEASTID .$row["ROLE_BREAST_ID"].",";
        
        return substr($roleBrEASTID, 0, -1);
    }
    
    public static function getDefaultListParams()
    {
        return array(1=>array(3,"REGION_ID"),2=>array(4,"RANDO_SITE_ID"),3=>array(5,"PATIENT_POSITION_ID"));
    }
    
    /**
     * array(orderBy=>array(parameterID,mapValue));
     */
    public static function createParams(array $rows)
    {
        $params=array();
        $reportForm =new ReportForm();
        $doubleKey = $reportForm->getDoubleKeyParams();
        $orderBy=1;
        foreach ($rows as $row)
            $params[$orderBy++]= array($row["PARAMETER_ID"],$doubleKey->getValue ($row["PARAMETER_ID"]));
            
        return $params;
    }
    
    public static function getSpecificParam(array $param,$reportID)
    {
        $cacheTime=Yii::app()->params["cacheTime"];
        $dependency = new CDbCacheDependency("SELECT COUNT(*) FROM WEBREPORTS.V_REPORTS WHERE REPORT_ID=$reportID");
        $dbCriteria=new CDbCriteria();
        $dbCriteria->select=$param["select"];
        $dbCriteria->group=$param["select"];
        $dbCriteria->order=$param["order"];
        return VReports::model()->cache($cacheTime,$dependency)->findAll($dbCriteria);
    }
}

?>

