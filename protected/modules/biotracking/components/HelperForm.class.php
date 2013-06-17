<?php

/**
 *  classe qui regroupe tout une liste de fonction pour aider à la génération de FORM pour biotracking
 */


class HelperForm
{
    private $datas; 
    public function __construct() 
    {
        
    }
    
    public function __destruct()
    {
        
    }
    
    public function setDataToDisplay (array $datas)
    {
        $this->datas=$datas;
    }
    
    public function getArray(array $models, $questionID,$emptyValue=false)
    {
        $arrayToReturn=array();
        if ($emptyValue)
            $arrayToReturn[""]="";
        foreach ($models as $model)
        {
            if ($model->QUESTION_ID==$questionID)
            {
                $questionValue=$model->QUESTION_VALUE;
                $arrayToReturn["$questionValue"]=$questionValue;
            }
        }

        return $arrayToReturn;
    }
    
    public function getListDataToDisplay ($questionID,$emptyValie=false)
    {
        $listData=array();
        if ($emptyValue)
            $listData[""]="";
        foreach ($this->datas as $data)
        {
            if ($data->QUESTION_ID==$questionID)
            {
                $questionValue=$model->QUESTION_VALUE;
                $listData["$questionValue"]=$questionValue;
            }
        }
        return $listData;
    }
    
}
?>
