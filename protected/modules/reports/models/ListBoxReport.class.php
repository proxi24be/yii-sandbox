<?php

class ListBoxReport 
{
    private $params;
    private $optionHtml;
    private $model;
    
    private $COLUMNS=array(2=>array("GROUP_ID","GROUP_NAME"),3=>array("REGION_ID","COUNTRY"),4=>array("RANDO_SITE_ID","RANDO_CRTN"),
        5=>array("PATIENT_POSITION_ID","PATIENT"),6=>array("GF_GROUP_ID","GROUP_NAME"));
    /**
     * @param array $params tableau associatif
     *  ex : array(order_by => attribute)
     */
    public function __construct($model,array $params, array $listBoxOptionHtml=array())
    {
        $this->params=$params;
        $this->optionHtml=$listBoxOptionHtml;
        $this->model=$model;
    }
    
    public function displayAllListBox()
    {
        Yii::beginProfile("displayAllListBox");
        if (count ($this->params) >0 )
        {
            foreach ($this->params as $orderBy => $values)
            {
                if ((int)$orderBy==1) // premier listbox
                {
                    $data=$this->fetchData($values[1]);
                    echo $this->displayListBox($values[1], $data);
                }
                else
                    echo $this->displayListBox($values[1]);
            }     
        }
        Yii::endProfile("displayAllListBox");
    }
    
    private function displayListBox($attribute,$data=array())
    {
        $content="";
        $content=$content.  CHtml::activeLabel($this->model, $attribute);
        $content=$content. CHtml::activeListBox($this->model, $attribute,$data,array("class"=>"report","multiple"=>"multiple"));
        
        return "<div class='span3'>$content</div>" ;
    }
    
    private function fetchData($attribute)
    {
        $sessionID=Yii::app()->session->getSessionID();
        $fileName="protected/runtime/reportJSON/$sessionID.serial";
        $studyID=12;
        $userID=Yii::app()->user->getID();
        $reportForm = new ReportForm($attribute);
        $doubleKey=$reportForm->getDoubleKeyParams();
        $parameterID=$doubleKey->getValue($attribute);
        if (file_exists($fileName))
            $userParams = unserialize(file_get_contents($fileName));
        // ajout d'une sécurité normamelement ça n'arrivera jamais 
        else  
        {
            $cacheTime=Yii::app()->params["cacheTime"];
            $dependency = new CDbCacheDependency("SELECT COUNT(*) FROM BREAST_REGISTRATION.V_USER_GROUP_PATIENT_SCREEN WHERE USER_ID=$userID");
            $criteria=new CDbCriteria();
            $criteria->condition="USER_ID=:userID AND STUDY_ID=:studyID";
            $criteria->params=array(":userID"=>(int)Yii::app()->user->getID(),":studyID"=>$studyID);
            $criteria->order="COUNTRY, RANDO_CRTN, PATIENT";
            $userParams=VUserGroupPatient::model()->cache($cacheTime,$dependency)->findAll($criteria);
        }
        
        $params=$this->COLUMNS[$parameterID];
        
        return CHtml::listData($userParams,$params[0],$params[1]);
    }
}

?>
