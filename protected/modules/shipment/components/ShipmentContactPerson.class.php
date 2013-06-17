<?php


class ShipmentContactPerson{


	public function __construct ()
	{

	}

	public function __destruct()
	{

	}

	public function getTOEmailAddress($condition,$params)
	{
            $tos = array();
            $criteria=new CDbCriteria;
            $columns= array("EMAIL_ENTERED");
            $criteria->select= $columns;
            $criteria->condition=$condition;
            $criteria->params=$params;
            $criteria->group="EMAIL_ENTERED";
            $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        
        if ($activeRecords != null)
        	foreach ($activeRecords as $activeRecord)
        					$tos[]=strtolower($activeRecord->EMAIL_ENTERED);
        return $tos;
	}

    public function getCcDMEmailAddress($condition,$params)
    {
        $ccs = array();
        $criteria=new CDbCriteria;
        $columns= array("REV_EMAIL");
        $criteria->select= $columns;
        $criteria->condition=$condition;
        $criteria->params=$params;
        $criteria->group="REV_EMAIL";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        
        if ($activeRecords != null)
            foreach ($activeRecords as $activeRecord)
                            $ccs[]=$activeRecord->REV_EMAIL;
        return $ccs;
    }

    public function getCcWorldEmailAddress($centreID)
    {
        $toWC= array();
        $activeRecord = VTransportCentres::model()->findByAttributes(array("CENTRE_ID"=>$centreID));
        
        if ($activeRecord != null)
                $toWC[]=strtolower($activeRecord->EMAIL);
        
        return $toWC;
    }


}


?>