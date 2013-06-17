<?php


class StudyRepository {

	private $studyRepository;

	public function __construct (){
		$this->studyRepository = array("APHINITY"=>
				"
				Tim Rackham
				Specimen Services (GATE F)
				B & C Group s.a.
				Watson and Crick Hill 
				Rue Granbonpré 11
				B-1348 Mont-Saint-Guibert
				Belgium
				Tel.:+32(0)10 238 858
				Fax.:+32(0)10 238 851
				Opening hours: Mon-Fri, 08h00-16h00");		
	}


	public function getAddress($study)
	{
		return $this->studyRepository[$study];
	}

}



?>