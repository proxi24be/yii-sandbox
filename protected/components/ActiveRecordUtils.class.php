<?php

class ActiveRecordUtils
{
    
    public static function getConditionAndParams ($post)
    {
        $valueToReturn["condition"]="";
        $valueToReturn["params"]=array();
        foreach ($post as $key => $value )
        {
            if (!empty($value))
            {
                $valueToReturn["condition"] = "$key=:$key and ".$valueToReturn["condition"];
                $valueToReturn["params"][":$key"] = is_numeric($value) ? (int)$value :$value;
            }
        }    
        
        $valueToReturn["condition"]= substr($valueToReturn["condition"], 0,-4);
        return $valueToReturn;
    }
    
}


?>
