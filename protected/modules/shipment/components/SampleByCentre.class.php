<?php

class SampleByCentre {
	
private $sampleIDAll;
private $centreIDAll;
private $sampleByCentre;
private $centreSampleDate; // array of array 

    public function __construct ()
    {

    }

    public function __destruct()
    {

    }

    public function setCentreIDAll(array $centreIDAll)
    {
        $this->centreIDAll=$centreIDAll;
    }

    public function setSampleIDAll(array $sampleIDAll)
    {
        $this->sampleIDAll=$sampleIDAll;
    }

   public function getCentreIDAll()
   {
       return $this->centreIDAll;
   }

   public function getSampleIDAll()
   {
       return $this->sampleIDAll;
   }

    public function equals(array $a, array $b)
    {
        return count($a)== count($b);
    }

    
    public function linkSampleToCentre(array $sampleIDAll, array $centreIDAll)
    {
        $this->sampleByCentre=array();
        $taille=count($centreIDAll);
        for ($i=0;$i<$taille ;$i++)
            $this->sampleByCentre[$centreIDAll[$i]][]=$sampleIDAll[$i];
        
        return $this->sampleByCentre;
    }
    
    public function linkCentreSampleDate(array $centreIDAll,array $sampleIDAll, array $dateAll)
    {
       $this->centreSampleDate= array ();
       $taille=count($centreIDAll);
        for ($i=0;$i<$taille ;$i++)
        {
            $temp=array();
            $temp["SAMPLE_ID"]=$sampleIDAll[$i];
            $temp["DATE"]=$dateAll[$i];
            $this->centreSampleDate[$centreIDAll[$i]][]=$temp;
        }
        return $this->centreSampleDate;
    }
    
    
    public function getSampleByCentre()
    {
        return $this->sampleByCentre;
    }

    
}   

?>