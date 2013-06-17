<?php
Yii::import ("application.vendors.*");
require_once ("html2pdf/html2pdf.class.php");

class PDFController extends Controller {

// public $layout="/layouts/aphinityPDFLayout";

	public function actionIndex()
	{
		$this->actionCreateAvailability();
	}

	public function actionCreateAvailability()
	{
		// il faudra envoyer un post ici 
		$criteria=new CDbCriteria;
        $columns= array("SAMPLE_ID","REQUEST_DATE","SAMPLE_NUMBER","SCREENING_NUMBER","MATERIAL_TYPE","COLLECTION_DATE");
        $criteria->select= $columns;
        $criteria->order="SAMPLE_ID";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        $td= array("SAMPLE_ID","SAMPLE_NUMBER","SCREENING_NUMBER","MATERIAL_TYPE","COLLECTION_DATE");
        $totalSample= count($activeRecords);
        $this->renderPartial("availabilityView",array("activeRecords" => $activeRecords, "td"=>$td, "totalSample"=>$totalSample));
	}

}

?>