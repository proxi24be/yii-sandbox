<?php

class ExcelBnc {

	private $parcelID;
	private $excel; 


	public function __construct ($parcelID)
	{
		$this->parcelID=$parcelID;
	}


	public function createFile ()
	{

		$issue="";
        ob_start();
        
        $activeRecords = $this->getInfoFromVMaterialRequested($this->parcelID);

        $columns_names=array("STUDY","MATERIAL_ID","COUNTRY","CENTRE NUMBER","PATIENT NUMBER","SEX","SAMPLE NUMBER","KIT NUMBER","VISIT","SAMPLE TYPE",
        	"SAMPLE DATE","SAMPLE TIME","COMMENTS","COMMENTS");
        $datas=array("STUDY","SAMPLE_ID","COUNTRY","CENTRE","SCREENING_NUMBER","SEX","SAMPLE_NUMBER","KIT_NUMBER","VISIT_NAME","MATERIAL_TYPE",
        	"COLLECTION_DATE","COLLECTION_TIME","COMMENTS","COMMENTS");
        $notExist= array("STUDY","SEX","KIT_NUMBER","COLLECTION_TIME","COMMENTS","COMMENTS");

        $number_of_cols=count($columns_names);

        // ************ Create the Excel file based on the view definition ***************

        // starting excel 
        $this->excel = new COM("Excel.application") or die("Unable to instanciate excel"); 
        //echo "Loaded excel, version {$excel->Version}\r\n";

        //bring it to front 
        $this->excel->DisplayAlerts = 0; 

        // ajouter un classeur
        $wkb=$this->excel->Workbooks->add();

        $sheets = $wkb->Worksheets(1); #Select the sheet

        $sheets->activate; #Activate it

        $sheets->name="B&C";

        // set the number of columns of the Excel sheeet based on the view definition
        // then we will fill it line by line using a query resultset

        // fill in headers

        $counter=0; // counter is used for the columns

        foreach($columns_names as $column_name){
            $counter++;
            
            $cell = $sheets->Cells(1,$counter);
            $cell->activate;
            $cell->value = $column_name;
        }

        // **************** Fill in the sheet with the data from the view **********************

        $counter_l=1; // counter_l is used for the lines

        // Fill in data
        foreach($activeRecords as $activeRecord){
            $counter_l++;
            $counter_c=0;

            foreach($datas as $data){
                $counter_c++; // 
                $cell = $sheets->Cells($counter_l, $counter_c);
                $cell->activate;
                if (in_array($data,$notExist))
                	$cell->value = "NA";
                else
                	$cell->value = $activeRecord->$data;
            }
        }

        $basename = "bc_".date('d-m-Y').".xls";
        $file="C:\\Program Files\\Zend\Apache2\\htdocs\\CliniFax_443\\BrEAST_YII\\temp\\pdf\\$basename";
        
        if (file_exists($file)) {unlink($file);}
        # saves sheet as final.xls
        $wkb->SaveAs($file); 
        
        //closing excel 
        $this->excel->Quit(); 
        
        $issue = ob_get_contents();
        ob_end_clean();
        
        //$myDebug->saveQuery($issue);
        
        if ($issue ==='')
            return "temp/pdf/$basename";    
        else
            return null;
        
        unset($this->excel);//Libération de l'instance $excel
	}


	private function getInfoFromVMaterialRequested($parcelID)
	{
		$criteria=new CDbCriteria;
        $criteria->condition="PARCEL_ID=:PARCELID AND SAMPLE_AVAILABILITY='Y' ";
        $criteria->params=array(":PARCELID"=>$parcelID);
        $criteria->order="SAMPLE_ID";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        return $activeRecords;
	}


}



?>