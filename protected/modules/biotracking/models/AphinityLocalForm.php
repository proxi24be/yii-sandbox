<?php
/*
 *  Remarque :  
 */
class AphinityLocalForm extends CFormModel
{
        public $pathologicalStage;
        public $sizeInvComp;
//        IHC
        public $IHCPerformed;
        public $IHCTestDate;
        public $IHCResult;
        public $percInvStaining;
        public $stainingAntibody;
        public $stainingAntibodyOther;
        public $IHCLocalGuidelines;
        public $IHCLocalGuidelinesNA;
        public $IHCPositivity;
        public $IHCCellPos;
//        ISH dual
        public $ISHDualPerformed;
        public $ISHDualTestDate;
        public $ISHKit;
        public $ISHKitOther;
        public $ISHDualResult;
        public $ISHDual17RatioUnit;
        public $ISHDual17RatioDecimal;
        public $ISHDualGeneCopyNumber;
        public $ISHDual17CopyNumber;
//        ISH single
        public $ISHSinglePerformed;
        public $ISHSingleTestDate;
        public $ISHSingleMethod;
        public $ISHSingleKit;
        public $ISHSingleKitCommercial;
        public $ISHSingleResult;
        public $ISHSingleGeneCopyNumber;
        public $ISHSingleAmplifiedOrNot;
        public $ISHSingleAmplifiedOrNotGeneCopy;
        public $ISHSingleAmplifiedOrNotOtherSpecify;
        
        public $localReceptorER;
        public $localReceptorPGR;
        public $localComment;
        public $localPathologistSigned;
        
        public $sampleID;
        public $formID;
        public $update;
	private $fields= 
        array("sizeInvComp"=>35,
            "pathologicalStage"=>221,
//            IHC 
            "IHCPerformed"=>222,
            "IHCTestDate"=>223,
            "IHCResult"=>12,
            "percInvStaining"=>224,
            "stainingAntibody"=>225,
            "stainingAntibodyOther"=>226,
            "IHCLocalGuidelines"=>227,
            "IHCLocalGuidelinesNA"=>228,
            "IHCPositivity"=>229,
            "IHCCellPos"=>230,
            
//            ISH dual colour
            "ISHDualPerformed"=>220,
            "ISHDualTestDate"=>231,
            "ISHKit"=>232,
            "ISHKitOther"=>233,
            "ISHDualResult"=>234,
            "ISHDual17RatioUnit"=>235,
            "ISHDual17RatioDecimal"=>236,
            "ISHDualGeneCopyNumber"=>237,
            "ISHDual17CopyNumber"=>238,
            
//            ISH Single colour
            "ISHSinglePerformed"=>242,
            "ISHSingleTestDate"=>243,
            "ISHSingleMethod"=>244,
            "ISHSingleKit"=>245,
            "ISHSingleKitCommercial"=>246,
            "ISHSingleResult"=>247,
            "ISHSingleGeneCopyNumber"=>248,
            "ISHSingleAmplifiedOrNot"=>249,
            "ISHSingleAmplifiedOrNotGeneCopy"=>250,
            "ISHSingleAmplifiedOrNotOtherSpecify"=>251,
            
            "localReceptorER"=>82,
            "localReceptorPGR"=>83,
            "localComment"=>43,
            "localPathologistSigned"=>57
            );
        
//        merci Vania
        private $oldValueToNewValue=array(
            12=>array("0"=>"0","1"=>"1+","2"=>"2+","3"=>"3+"),
            225=>array("Dako Hercep Test"=>"Dako HercopTest","Lab Developed Test"=>"Lab developed test","other"=>"Other","Unknow or not available"=>"Unknown or not available"),
            227=>array("Not Available"=>"Not available"),
            229=>array("ASCO/CAP"=>"ASCO/CAP guidelines (Complete membrane staining in >30% of tumor cells)","Approved label"=>"Approved label (Complete membrane staining in >10% of tumor cells)"),
            232=>array("Lab Developed"=>"Lab developed test","Abbott"=>"Abbott PathVysion HER2 (FISH)","Dako Fish"=>"DAKO HER2 FISH PharmDx (FISH)","Leica"=>"Leica BOND FISH",
                "Ventana"=>"Ventana INFORM HER2 (ddISH)","Invitrogen"=>"Invitrogen SPoT-Light HER2 (CISH)","Dako Cish"=>"DAKO HER2 DuoCISH pharmDX (CISH)",
                "Other"=>"Other commercial ISH test","Unknown"=>"Unknown or not available"),
            238=>array("Polysomy"=>"Polysomy (3 or more signals in >= 30% of cells)","Monosomy"=>"Monosomy (60% of cells with one or no signals)",
                "Normal"=>"Normal","Not Available"=>"Not available"),
            245=>array("Lab developed"=>"Lab developed reagent"),
            247=>array("Not amplified"=>"Not Amplified"),
            249=>array("asco"=>"ASCO/CAP guidelines (HER2/CEP17 ratio >= 2.2)","CEP17"=>"Assay label (HER2/CEP17 ratio >= 2)",
                "gene"=>"Assay label (HER2 Gene copy > _ 4 or 5 or 6)","other"=>"Other")
            );
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            return array(
		        array("sampleID","required"),
                array("pathologicalStage","required","message"=>"Please select a response"),
                array('IHCPerformed', 'required', "message"=>"Please confirm if IHC test has been performed"),
                array('ISHDualPerformed', 'required', "message"=>"Please confirm if ISH dual colour test has been performed"),
                array('ISHSinglePerformed', 'required', "message"=>"Please confirm if ISH single colour test has been performed"),
                array('IHCPerformed', 'required', "message"=>"Please confirm if IHC test has been performed"),
                
                array('sizeInvComp', 'required'),
                array('sizeInvComp', 'acceptNAAndCutOff'),
                array('localReceptorER', 'required', "message"=>"Please specify status ER"),
                array('localReceptorPGR', 'required', "message"=>"Please specify status PgR"),
                array('localPathologistSigned', 'required', "message"=>"Please confirm if the pathologist has signed the analysis"),
                
//                IHC results
                array('IHCTestDate','required',"message"=>"The field cannot be blank","on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                array('percInvStaining','percInvStaining',"message"=>"The field cannot be blank","on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                array('IHCResult,stainingAntibody,IHCLocalGuidelines,IHCPositivity ', 'required', "message"=>"Please select a response","on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                array('stainingAntibodyOther', 'stainingAntibodyOther', "on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                array('IHCLocalGuidelinesNA', 'IHCLocalGuidelinesNA', "on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                array('IHCCellPos', 'IHCCellPos', "on"=>"ICH, ICHAndISHDual, ICHAndISHSingle, ICHAndISHDualAndISHSingle"),
                
//                ISH Dual colour
                array('ISHDualTestDate,ISHDualTestDate,IHCResult,ISHKit,ISHDualResult, ISHDual17RatioUnit, ISHDual17RatioDecimal, ISHDualGeneCopyNumber, ISHDual17CopyNumber','required','on'=>'ISHDual, ICHAndISHDual, ICHAndISHDualAndISHSingle,ISHDualAndISHSingle'),
                array('ISHKitOther','ISHKitOther','on'=>'ISHDual, ICHAndISHDual, ICHAndISHDualAndISHSingle,ISHDualAndISHSingle'),
                
//                ISH Single colour
                array('ISHSingleTestDate, ISHSingleMethod, ISHSingleKit, ISHSingleKitCommercial, ISHSingleResult, ISHSingleGeneCopyNumber, ISHSingleAmplifiedOrNot','required','on'=>'ISHSingle, ICHAndISHSingle, ICHAndISHDualAndISHSingle,ISHDualAndISHSingle'),
                array('ISHSingleAmplifiedOrNotGeneCopy','ISHSingleAmplifiedOrNotGeneCopy','on'=>'ISHSingle, ICHAndISHSingle, ICHAndISHDualAndISHSingle,ISHDualAndISHSingle'),
                
                array('ISHSingleAmplifiedOrNotOtherSpecify','ISHSingleAmplifiedOrNotOtherSpecify','on'=>'ISHSingle, ICHAndISHSingle, ICHAndISHDualAndISHSingle,ISHDualAndISHSingle'),
                
//                contraite de YII si je n'ajoute pas cette règle YII ignora ces champs lors de la mass assignation
//                cette règle dit à YII qu'il peut le faire en "tout confiance" 
                array("IHCTestDate,percInvStaining, IHCResult,stainingAntibody,stainingAntibodyOther,IHCLocalGuidelines,IHCLocalGuidelinesNA,IHCPositivity ,IHCCellPos, ISHDualTestDate,ISHDualTestDate,IHCResult,ISHKit, ISHKitOther, 
                    ISHDualResult, ISHDual17RatioUnit, ISHDual17RatioDecimal, ISHDualGeneCopyNumber, ISHDual17CopyNumber, ISHSingleTestDate, ISHSingleMethod, ISHSingleKit, ISHSingleKitCommercial, ISHSingleResult, ISHSingleGeneCopyNumber, 
                    ISHSingleAmplifiedOrNot, ISHSingleAmplifiedOrNotGeneCopy, ISHSingleAmplifiedOrNotOtherSpecify ","safe"),
                array("formID,update","safe"),
            );
	}
        
        public function percInvStaining($attribute)
        {
            if (strtolower($this->IHCResult)=="3+")
            {
                if (empty ($this->$attribute))
                        $this->addError($attribute,"You have selected result 3+, please specify the percentage of invasive tumours");
                else
                    $this->acceptNAAndCutOff($attribute);
            }
        }
        
        public function stainingAntibodyOther ($attribute)
        {
            if (strtolower($this->stainingAntibody)=="other" && empty ($this->$attribute) )
                    $this->addError($attribute,"You have selected other commercial test, please specify it");
        }
        
        public function IHCLocalGuidelinesNA ($attribute)
        {
            if (strtolower($this->IHCLocalGuidelines)=="not available" && empty ($this->$attribute) )
                    $this->addError($attribute,"You have selected not available local guidelines, please specify it");
        }
        
        public function IHCCellPos ($attribute)
        {
            if (strtolower($this->IHCPositivity)=="local guideline" )
                        $this->acceptNAAndCutOff ($attribute);
        }
        
        public function ISHKitOther ($attribute)
        {
            if (strtolower($this->ISHKit)=="other commercial ish test" && empty ($this->$attribute) )
                    $this->addError($attribute,"You have selected other commercial ISH test, please specify it");
        }
        
        public function ISHSingleAmplifiedOrNotGeneCopy($attribute)
        {
            if (strtolower($this->ISHSingleAmplifiedOrNot)=="assay label (her2 gene copy > _ 4 or 5 or 6)" && empty ($this->$attribute) )
                    $this->addError($attribute,"Please specifcy assay label(HER2 gene copy) value");
        }
        
        public function ISHSingleAmplifiedOrNotOtherSpecify($attribute)
        {
            if (strtolower($this->ISHSingleAmplifiedOrNot)=="other" && empty ($this->$attribute) )
                    $this->addError($attribute,"The field cannot be blank");
        }

	public function acceptNA($attribute)
	{
            if ( ! is_numeric($this->$attribute))
                    if(strtoupper($this->$attribute) !=='NA')
                            $this->addError($attribute,"The value you enter must be a numeric or in case of exception NA value is accepted");
	}
        
        public function acceptNAAndCutOff($attribute)
        {
            if (!is_numeric($this->$attribute))
                    if(strtoupper($this->$attribute) !=='NA' && !preg_match("((>|<){1}(=){0,1}\d{1,2})", $this->$attribute))
                            $this->addError($attribute,"The value you enter must be a <b>numeric</b> or in case of exception <b>NA</b> or <b>Cut-off</b> value are accepted");
        }
        
	public function getFields()
	{
		return $this->fields;
	}
        
        public function massAssignation(array $responses)
        {
            foreach ($responses as $response)
                foreach ($this->fields as $attribute => $questionID)
                   if ($response->QUESTION_ID==$questionID)
                           $this->$attribute=$this->transformOldValueToNewValue ($questionID, $response->VALUE);
        }
        
        public function computeScenario()
        {
            $scenario=0;
            $scenario += strtoupper($this->IHCPerformed)=="YES" ? 5 : 0;
            $scenario += strtoupper($this->ISHDualPerformed)=="YES" ? 7 : 0;
            $scenario += strtoupper($this->ISHSinglePerformed)=="YES" ? 11 : 0;
            
            switch ($scenario) 
            {
                case 5: return "ICH";
                case 7: return "ISHDual";
                case 11: return "ISHSingle";
                case 12: return "ICHAndISHDual";
                case 16: return "ICHAndISHSingle";
                case 23: return "ICHAndISHDualAndISHSingle";
                case 18: return "ISHDualAndISHSingle";

                default: return "";
            }
        }
        
        public function attributeLabels()
	{
            return array(
                "pathologicalStage"=>"Pathological stage of initial breast cancer diagnosis",
                "sizeInvComp"=>"Size of invasive component present in the embedded tumour",
                
                "IHCCellPos"=>"Specify the cut-off of cells with complete membrane staining",
                "localReceptorER"=>"Local hormonal receptor status ER",
                "localReceptorPGR"=>"Local hormonal receptor status PgR",
                "localComment"=>"Comment",
                "localPathologistSigned"=>"Pathologist has signed the analysis",
                
                "IHCTestDate"=>"Sample test date(dd/mm/yyyy)",
                "IHCPerformed"=>"Was IHC performed ?",
                "IHCResult"=>"IHC result",
                "percInvStaining"=>"Percentage of invasive tumours cells with moderate to intense circonferential membrane staining (3+)",
                "stainingAntibody"=>"Staining antibody",
                "stainingAntibodyOther"=>"Other, specify",
                "IHCLocalGuidelines"=>"IHC Result per local guidelines",
                "IHCLocalGuidelinesNA"=>"Not available specification",
                "IHCPositivity"=>"HER2 IHC Positivity is determined according to",
                
                "ISHDualPerformed"=>"Was ISH dual colour performed ?",
                "ISHDualTestDate"=>"Sample test date(dd/mm/yyyy)",
                "ISHKit"=>"Kit or test type",
                "ISHKitOther"=>"Other commercial ISH test, specify",
                "ISHDualResult"=>"Dual colour ISH result",
                "ISHDualGeneCopyNumber"=>"Dual colour ISH HER2 gene copy number",
                "ISHDual17CopyNumber"=>"Dual colour ISH Chromosome 17 copy number",
                
                "ISHSinglePerformed"=>"Was ISH single colour performed ?",
                "ISHSingleTestDate"=>"Sample test date(dd/mm/yyyy)",
                "ISHSingleMethod"=>"Method",
                "ISHSingleKit"=>"Kit used",
                "ISHSingleKitCommercial"=>"specify",
                "ISHSingleResult"=>"ISH Single colour (single probe) result",
                "ISHSingleGeneCopyNumber"=>"ISH Single colour (single probe) HER2 gene copy number",
                "ISHSingleAmplifiedOrNot"=>"HER2 ISH result amplified or not was determined according to",
                "ISHSingleAmplifiedOrNotGeneCopy"=>"Assay label(HER2 gene copy) value",
                "ISHSingleAmplifiedOrNotOtherSpecify"=>"Other, specify",
            );
	}
        
        public function getMappingOldValueToNewValue ()
        {
            return $this->oldValueToNewValue;
        }
        
        public function getMapCompatibilityMode()
        {
            return $this->reverseNewValueToOldValue($this->oldValueToNewValue);
        }
        
        /**
         * fonction qui est en charge de faire la correspondance des anciennes valeurs avec les nouvelles
         */
        private function transformOldValueToNewValue ($questionID,$response)
        {
            if (key_exists($questionID,$this->oldValueToNewValue ))
            {
                $values = $this->oldValueToNewValue[$questionID];
                if (key_exists($response,$values))
                {
                    $oldToNew = $values[$response];
                    return $oldToNew;
                }
            }
            return $response;
        }
        
        private function reverseNewValueToOldValue($array)
        {
            $valueToReturn=array();
            foreach ($array as $questionID =>$arr)
            {
                $temp=array();
                foreach ($arr as $oldValue => $newValue)
                    $temp[$newValue]=$oldValue;
                
                $valueToReturn[$questionID]=$temp;
            }
            return $valueToReturn;
        }
}

?>
