<?php

/**
 *  class qui facilite la manipulation entre 2 tableaux qu'on doit mapper
 */

class DoubleKey
{

    private $keys1;
    private $keys2;
    
    public function __construct(array $keys1, array $keys2) 
    {
        if (count($keys1) != count($keys2))
            throw new Exception ("the two arrays are not the same size");
        
        $this->keys1=$keys1;
        $this->keys2=$keys2;
    }
    
    public function getValue ($key)
    {
       $temp1= array_keys($this->keys1,$key);
       if (count($temp1)==0)
       {
           $temp2=array_keys($this->keys2,$key);
           if (count($temp2)==0)
                return null;
           else
               return $this->keys1[$temp2[0]];
       }
       else
           return $this->keys2[$temp1[0]];
    }
}

?>
