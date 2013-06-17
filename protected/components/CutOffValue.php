<?php

class CutOffValue
{
    private $value;
    
    public function __construct($value=null)
    {
        if ($value!=null)
            $this->setValue ($value);
    }
    
    public function setValue($value)
    {
        $this->value=trim($value);
        $this->value=str_replace(" ","",$this->value);
        $this->value=str_replace(",",".",$this->value);
    }
    
    public function getValue ()
    {
        return $this->value;
    }
    
    public function isValidPattern()
    {
        $match= preg_match('/^(([><]=?|[><]?)\d)/', $this->value) ;
        if ($match ===false || $match ===0)
            return false;
        else
            return true;
    }
    
    public function convertCutOffValue()
    {
       $valueToReturn = $this->value;
       
       if (preg_match("/>\d+/",$valueToReturn)===1)
       {
           $valueToReturn= str_replace (">","",$valueToReturn);
           $valueToReturn = floatval($valueToReturn) + 0.01;
       }
       else if (preg_match("/<\d+/",$valueToReturn)===1)
       {
           $valueToReturn= str_replace ("<","",$valueToReturn);
           $valueToReturn = floatval($valueToReturn) - 0.01;
       }
       else
       {
           $valueToReturn= str_replace("=","",$valueToReturn);
           $valueToReturn= str_replace("<","",$valueToReturn);
           $valueToReturn= str_replace(">","",$valueToReturn);
       }
       return $valueToReturn;
    }
}



?>
