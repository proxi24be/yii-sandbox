<?php

class CentreSample {
	
private $tabSamples;
private $parcelCentreSamples;
private $tabCentreIDs;
private $sampleByCentre;

    public function __construct (array $samples)
    {
        $this->tabSamples=$samples;
    }

    public function getCentreSamples ()
    {
        return $this->createCentreSample();
    }

    public function setCentreIDAll(array $centreIDAll)
    {
        $this->tabCentreIDs=$centreIDAll;
    }

    public function setSampleIDAll(array $sampleIDAll)
    {
        $this->tabSamples=$sampleIDAll;
    }

   public function getCentreIDAll()
   {
       return $this->tabCentreIDs;
   }

   public function getSampleIDAll()
   {
       return $this->tabSamples;
   }

    public function equals(array $a, array $b)
    {
        return count($a)== count($b);
    }

    public function getCentreSampleReminder()
    {
        return $this->createCentreSampleReminder();
    }
    
    public function linkSampleToCentre(array $sampleIDAll, array $centreIDAll)
    {
        $this->sampleByCentre=array();
        $taille=count($centreIDAll);
        for ($i=0;$i<$taille ;$i++)
            $this->sampleByCentre[$centreIDAll[$i]][]=$sampleIDAll[$i];
        
        return $this->sampleByCentre;
    }
    
    public function getSampleByCentre()
    {
        return $this->sampleByCentre;
    }

    private function createCentreSample ()
    {
        $this->parcelCentreSamples = new ParcelCentreSamples;
        foreach ($this->tabSamples as $sampleID)
        {
                $centre=VMaterialsOnSite::model()->find("MATERIAL_ID=:MATERIAL_ID",array(":MATERIAL_ID"=>$sampleID));
                if ($centre != null)
                    $this->parcelCentreSamples->addCentreSamples($centre->CENTRE_ID,$sampleID);
        }
        return $this->parcelCentreSamples->getCentreSamples();
    }

    private function createCentreSampleReminder ()
    {
        $this->parcelCentreSamples = new ParcelCentreSamples;
        foreach ($this->tabSamples as $sampleID)
        {
                $centre=  VMaterialsRequested::model()->find("SAMPLE_ID=:SAMPLE_ID",array(":SAMPLE_ID"=>$sampleID));
                if ($centre != null)
                    $this->parcelCentreSamples->addCentreSamples($centre->CENTRE_ID,$sampleID);
        }
        return $this->parcelCentreSamples->getCentreSamples();
    }
}        
?>