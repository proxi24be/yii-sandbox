<?php
// permet d'utiliser la classe email sinon quoi il faut une erreur de deprecated à cause de la version de PHP
error_reporting(E_ALL ^E_DEPRECATED);

define('MAIL_SERVER', 'c2srvmail.bordet.be');
define('BNCEMAIL', 'sm@bnc-group.com');

Yii::import ("application.vendors.*");
Yii::import ("application.modules.biotracking.models.*");
require_once ("html2pdf/html2pdf.class.php");
require_once ("MyUtils.class.php");
require_once("ParcelCentreSamples.class.php");
require_once ("MyParcel.class.php");
require_once("phpmailer/class.phpmailer.php");
require_once("MyMails.class.php");
require_once("ExcelBnc.class.php");
require_once ("StudyRepository.php");
require_once("ShipmentContactPerson.class.php");
require_once("CentreSample.class.php");
require_once ("ActiveRecordUtils.class.php");


class TranslationalController extends Controller {
    
    public $layout="/layouts/ShipmentLayout";
    private $listOfReceivers= array ("Study Repository"=>"Study Repository","Site"=>"Site","Courier Company"=>"Courier Company");
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow only authenticated to perform 'index' and 'view' actions
                "users"=>array('@'),
                'expression'=>'$user->title=="IT" ||  $user->title=="TRANSLATIONAL COORDINATOR" || $user->title=="DATA MANAGER"',
            ),
            
            array('deny',  // deny all users
                'users'=>array('*'),
                'message'=>'Access Denied.',
            ),
        );
    }

    public function actionIndex()
    {
        $this->actionRequest();
    }

    public function actionRequest()
    {
        $this->render("requestView");
    }
    
    public function actionGetAllSample()
    {
        if (isset ($_POST["STUDY_ID"]))
        {
            $columns= array("COUNTRY_ID","COUNTRY","CENTRE", "CENTRE_ID","PATIENT_ID","SCREENING_NUMBER","VISIT_ID","VISIT_NAME");
            $criteria=new CDbCriteria;
            $criteria->select= "COUNTRY_ID,COUNTRY,CENTRE, CENTRE_ID,PATIENT_ID,SCREENING_NUMBER,VISIT_ID,VISIT_NAME";
            $criteria->condition="STUDY_ID=:STUDY_ID AND MATERIAL_TYPE_ID NOT IN (54,58,59,60)";
            $criteria->params=array(":STUDY_ID"=>(int)$_POST["STUDY_ID"]);
            $criteria->group="COUNTRY_ID,COUNTRY,CENTRE, CENTRE_ID,PATIENT_ID,SCREENING_NUMBER,VISIT_ID,VISIT_NAME";
            $rows = VMaterialsOnSite::model()->findAll($criteria);
            echo CJSON::encode($rows);
        }
    }

    public function actionDynamicCountry ()
    {
        if (isset($_POST["STUDY_ID"]))
        {
            $data = MyUtils::getDataForSelectFromModel(VMaterialsOnSite::model(),"STUDY_ID=:STUDY_ID",array(":STUDY_ID"=>(int)$_POST["STUDY_ID"]),
            array("COUNTRY_ID","COUNTRY"));
            asort($data);
            $tags = MyUtils::generateTagElems("option",MyUtils::addEmpty($data));
            MyUtils::displayTags($tags);    
        }
    }

    public function actionDynamicCentre ()
    {
        if (isset($_POST["COUNTRY_ID"]))
        {
            $data = MyUtils::getDataForSelectFromModel(VMaterialsOnSite::model(),"COUNTRY_ID=:COUNTRY_ID AND STUDY_ID=:STUDYID",
            array(":COUNTRY_ID"=>(int)$_POST["COUNTRY_ID"], ":STUDYID"=>(int)$_POST["STUDY_ID"]),array("CENTRE_ID","CENTRE"));
            asort($data);
            $tags = MyUtils::generateTagElems("option",MyUtils::addEmpty($data));
            MyUtils::displayTags($tags);    
        }
    }


    public function actionDynamicVisit ()
    {
        if (isset($_POST["CENTRE_ID"]))
        {
            $data = MyUtils::getDataForSelectFromModel(VMaterialsOnSite::model(),"COUNTRY_ID=:COUNTRY_ID AND STUDY_ID=:STUDYID AND CENTRE_ID=:CENTREID",
            array(":COUNTRY_ID"=>(int)$_POST["COUNTRY_ID"], ":STUDYID"=>(int)$_POST["STUDY_ID"],":CENTREID"=>(int)$_POST["CENTRE_ID"]),array("VISIT_ID","VISIT_NAME"));
            asort($data);
            $tags = MyUtils::generateTagElems("option",MyUtils::addEmpty($data));
            MyUtils::displayTags($tags);    
        }
    }
        
    public function actionDynamicPatient ()
    {
        if (isset($_POST["CENTRE_ID"]))
        {
            $data = MyUtils::getDataForSelectFromModel(VMaterialsOnSite::model(),"COUNTRY_ID=:COUNTRY_ID AND STUDY_ID=:STUDYID AND VISIT_ID=:VISITID AND CENTRE_ID=:CENTREID",
            array(":COUNTRY_ID"=>(int)$_POST["COUNTRY_ID"], ":STUDYID"=>(int)$_POST["STUDY_ID"], ":VISITID"=>(int)$_POST["VISIT_ID"],":CENTREID"=>(int)$_POST["CENTRE_ID"]),
            array("PATIENT_ID","SCREENING_NUMBER"));
            asort($data);
            $tags = MyUtils::generateTagElems("option",MyUtils::addEmpty($data));
            MyUtils::displayTags($tags);    
        }
    }

    public function actionMaterialToShip()
    {
        if (isset($_POST["STUDY_ID"]) && $_POST["STUDY_ID"] !='empty' )
        {
            $criteria=new CDbCriteria;
            $columns= array("MATERIAL_ID","VISIT_NAME","CENTRE","SCREENING_NUMBER","MATERIAL_TYPE","SAMPLE_NUMBER","COLLECTION_DATE","CRYOVIALS_NUMBER","TEMPERATURE");
            $criteria->select= $columns;
            $conditionAndParams= ActiveRecordUtils::getConditionAndParams($_POST);
            
            $criteria->condition=$conditionAndParams["condition"];
            $criteria->params=$conditionAndParams["params"];
            
            $criteria->addCondition("(MATERIAL_STATE IN ('GOOD','ACCEPTABLE') OR MATERIAL_STATE IS NULL) AND MATERIAL_TYPE_ID NOT IN (54,58,59,60)");
            $criteria->order="MATERIAL_ID, MATERIAL_TYPE";
            $activeRecords = VMaterialsOnSite::model()->findAll($criteria);
            $td= $columns;
            $this->renderPartial ("_requestView",array("activeRecords" => $activeRecords, "td"=>$td));    
        }
        
        else{
            echo "please select the study !";
        }
    }

    public function actionRequestAvailability()
    {
        if (isset($_POST["MATERIAL_ID"]) ||isset($_POST["SAMPLE_ID"]))
        {
            if (isset($_POST["REMINDER"]) && $_POST["REMINDER"]=="REMINDER" )  // un simple flag
            {
                $centreSample=new CentreSample($_POST["SAMPLE_ID"]);
                $reminder="REMINDER";
                $requestToSend=$centreSample->getCentreSampleReminder();
            }
            else
            {
                $centreSample=new CentreSample($_POST["MATERIAL_ID"]);
                $reminder="";
                $requestToSend=$centreSample->getCentreSamples();
            }
            
            if (count ($requestToSend)>0)
            {
                $counter=0;
                foreach($requestToSend as $centreID => $tabSampleID )
                {
                    if (!isset($_POST["REMINDER"]))
                    {
                        foreach($requestToSend[$centreID] as $sampleID)
                        {
                            $parcelSample = new ParcelSamples;
                            $parcelSample->PARCEL_ID=0;
                            $parcelSample->SAMPLE_ID=$sampleID;
                            $parcelSample->REQUEST_DATE=new CDbExpression("SYSDATE");
                            $parcelSample->save();
                        }
                    }
                    // creation du fichier pdf
                    $this->createAvailability($centreID,$requestToSend[$centreID],$reminder);
                    // envois de l'email
                    $this->sendEmailAvailability($centreID,$reminder);
                }
                echo CJSON::encode(array("status"=>"success"));
            }
                
            else
                echo CJSON::encode(array("status"=>"failed", "errormsg"=>"attachement sample to parcel impossible !"));
        }
        else
            echo CJSON::encode(array("status"=>"failed", "errormsg"=>"no sample has been selected !"));
    }

    public function actionRequestedSample()
    {
        $criteria=new CDbCriteria;
        $columns= array("SAMPLE_ID",'REQUEST_DATE',"CENTRE","SCREENING_NUMBER","MATERIAL_TYPE","SAMPLE_NUMBER");
        $criteria->select= $columns;
        $criteria->condition="CONFIRMATION_DATE IS NULL AND MATERIAL_TYPE_ID NOT IN (54,58,59,60)";
        $criteria->order="SAMPLE_ID,SCREENING_NUMBER";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        $td= $columns;
        $this->render("requestedSampleView",array("activeRecords" => $activeRecords, "td"=>$td));
    }

    public function actionRequestShipment()
    {
        $criteria=new CDbCriteria;
        $columns= array("SAMPLE_ID",'REQUEST_DATE',"CENTRE","CONFIRMATION_DATE","SCREENING_NUMBER","MATERIAL_TYPE",
        "SAMPLE_NUMBER");
        $criteria->select= $columns;
        $criteria->condition="CONFIRMATION_DATE IS NOT NULL AND REQUEST_DATE_SHIPMENT IS NULL AND SAMPLE_AVAILABILITY='Y' AND VISIT_NAME <>'SCREENING'";
        $criteria->order="SAMPLE_ID,SCREENING_NUMBER";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        $td= $columns;
        
        $this->render("requestShipmentView",array("activeRecords" => $activeRecords, "td"=>$td,"listOfReceivers"=>$this->listOfReceivers
                ,"receiverCheckByDefault"=>array_keys($this->listOfReceivers)));
    }

    public function actionSendShipmentRequest()
    {
        if (isset ($_POST["SAMPLE_ID"]))
        {
            $myParcel=new MyParcels($_POST["SAMPLE_ID"]);
            $parcelCentreSamples=$myParcel->createParcel();
            $tabParcelID=$myParcel->attachSampleToParcels($parcelCentreSamples);
            foreach ($tabParcelID as $parcelID => $value)
            {
                $criteria=new CDbCriteria;
                $columns= array("SAMPLE_ID",'SAMPLE_NUMBER',"SCREENING_NUMBER","MATERIAL_TYPE","CENTRE_ID");
                $criteria->select= $columns;
                $criteria->condition="SAMPLE_AVAILABILITY='Y' AND PARCEL_ID=:PARCELID";
                $criteria->params=array(":PARCELID"=>(int)$parcelID);
                $criteria->order="PARCEL_ID, SAMPLE_ID,SCREENING_NUMBER";
                $activeRecords = VMaterialsRequested::model()->findAll($criteria);
                $totalSample=count($activeRecords);

                $td=array("SAMPLE_ID",'SAMPLE_NUMBER',"SCREENING_NUMBER","MATERIAL_TYPE");
                $centreID = $activeRecords[0]->CENTRE_ID;
                $centreInformation=VCentreAddressPI::model()->find("CENTRE_ID=:CENTREID",array(":CENTREID"=>$centreID));

                $shipmentContactPerson = new ShipmentContactPerson;
                $toSite= $shipmentContactPerson->getTOEmailAddress("PARCEL_ID=:PARCELID",array(":PARCELID"=>(int)$parcelID));
                $ccDM=$shipmentContactPerson->getCcDMEmailAddress("PARCEL_ID=:PARCELID",array(":PARCELID"=>(int)$parcelID));
                $toWC = $shipmentContactPerson->getCcWorldEmailAddress($centreID);

                ob_start();
                print_r($toSite);
                print_r($ccDM);
                print_r($toWC);
                Yii::log(ob_get_contents(),'warning','app.shipment');
                ob_end_clean();

                $content=$this->renderPartial("shipmentSitePDFView",array("activeRecords"=>$activeRecords, "td"=>$td, "parcelID"=>$parcelID, "totalSample"=>$totalSample),true);
                $this->createPDFToSend($content,"temp/pdf/shipment_$parcelID.pdf");

                $studyRepository= new StudyRepository;
                $address= $studyRepository->getAddress("APHINITY");

                $content=$this->renderPartial("shipmentTransportPDFView",array("activeRecords"=>$activeRecords, "td"=>$td, "parcelID"=>$parcelID,
                    "totalSample"=>$totalSample, "centreInformation"=>$centreInformation,"studyRepository"=>$address),true);
                $this->createPDFToSend($content,"temp/pdf/transport_$parcelID.pdf");

                $samplesIDS = $this->getSampleIDFromParcel($parcelID);

                if ($samplesIDS != null)
                        $this->updateSampleLocation($samplesIDS);

                if (isset($_POST["listOfReceivers"]) && in_array ("Site",$_POST["listOfReceivers"]))
                        $this->sendEmailShipmentToSite($parcelID,$centreInformation,$toSite,$ccDM);

                if (isset($_POST["listOfReceivers"]) && in_array ("Courier Company",$_POST["listOfReceivers"]))
                        $this->sendEmailShipmentToTransport($parcelID,$centreInformation,$toWC,$ccDM);

                if (isset($_POST["listOfReceivers"]) && in_array ("Study Repository",$_POST["listOfReceivers"]))
                        $this->sendEmailToBnc($parcelID,$centreInformation);
            }
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect("https://www.br-e-a-s-t.org");
    }

    private function createAvailability ($centreID,$tabSampleID,$reminder)
    {
        $contentPDF=new ContentPDF();
        $result=$contentPDF->getAvailabilityContentPDF($tabSampleID);
        $records=MyUtils::groupArrayByKey("SCREENING_NUMBER", $result);
        $totalSample=0;
        $patients=array_keys($records);
        if (count ($patients)>0)
            foreach($patients as $patient)
                $totalSample= $totalSample + count($records[$patient]);

        $td= array("SAMPLE_ID","SAMPLE_NUMBER","MATERIAL_TYPE","COLLECTION_DATE","REQUEST_DATE");
        $content=$this->renderPartial("availabilityPDFView",array("records"=>$records, "td"=>$td, "totalSample"=>$totalSample,"reminder"=>$reminder),true);
        $this->createPDFToSend ($content,"temp/pdf/request_$centreID.pdf");
    }

    private function getDistinctParcel (array $post)
    {
        $tabParcelID= array();
        foreach ($_POST["PARCEL_ID"] as $parcelID)
                if ( !in_array($parcelID,$tabParcelID ))
                        $tabParcelID[]=$parcelID;

        return $tabParcelID;
    }

    private function createPDFToSend ($content, $pathOutput)
    {
        try 
        {
            $html2pdf = new HTML2PDF('P','A4','fr');
            $html2pdf->WriteHTML($content);
            $html2pdf->Output($pathOutput,'F');
        }    
        catch (HTML2PDF_exception $e) 
        {
            echo $e;
            exit;
        }
    }

    private function getSampleIDFromParcel($parcelID)
    {
        $criteria=new CDbCriteria;
        $columns= array("SAMPLE_ID");
        $criteria->select= $columns;
        $criteria->condition="PARCEL_ID=:PARCELID AND SAMPLE_AVAILABILITY='Y' ";
        $criteria->params=array(":PARCELID"=>$parcelID);
        $criteria->order="SAMPLE_ID";
        $activeRecords = VMaterialsRequested::model()->findAll($criteria);
        return $activeRecords;
    }

    private function updateSampleLocation(array $sampleIDS)
    {
        foreach ($sampleIDS as $sampleID)
        {
            $materialLocation=new MaterialLocation;
            $materialLocation->MATERIAL_ID=$sampleID->SAMPLE_ID;
            $materialLocation->LOCATION_ID=0; // par convention 0 veut dire qu'il ne se trouve à propement parler null part
            $materialLocation->LOC_TYPE_ID=4; // chez le transporteur
            $materialLocation->TIMESTAMP = new CDbExpression("SYSDATE");
            $materialLocation->save();
        }
    }

    private function sendEmailAvailability($centreID,$reminder)
    {
        $centreInformation=VCentreAddressPI::model()->find("CENTRE_ID=:CENTREID",array(":CENTREID"=>$centreID));
        $country=$centreInformation->COUNTRY;
        $centre=$centreInformation->CENTRE;
        $study=$centreInformation->STUDY;

        $shipmentContactPerson = new ShipmentContactPerson;
        $toSite= $shipmentContactPerson->getTOEmailAddress("CENTRE_ID=:CENTREID",array("CENTREID"=>(int)$centreID));
        $ccDM=$shipmentContactPerson->getCcDMEmailAddress("CENTRE_ID=:CENTREID",array("CENTREID"=>(int)$centreID));

        $attachment =array("temp/pdf/request_$centreID.pdf"=>"aphinity_request_availability_".$country."_".$centre.".pdf");
        $from="breast.translational@bordet.be";
        $fromName="breast translational";
        
        $monitorAndPI = $this->getPIAndMonitor($centre);
        foreach ($monitorAndPI as $email)
            $ccDM[]=$email;

        if (Yii::app()->params['environment'] <>'prod')
        {
            $toSite=array("ngocvu.tran@bordet.be");
            $ccDM=array();
        }
        
        $bcc=array("ngocvu.tran@bordet.be");
        
        $pathToTemplateEmail= Yii::getPathOfAlias("application.modules.shipment.models.emails") ;
        $emailTemplate= file_get_contents("$pathToTemplateEmail\\EmailAvailabilityToSite.txt");
        
        $emailTemplate=str_replace("{reminder}", $reminder, $emailTemplate);
        
        $subject="$reminder $study biotracking : shipment request sample availability - $country - $centre";
        $body=utf8_decode($emailTemplate);
        
        $myMails = new MyMails ($from,$fromName, $toSite, $ccDM, $bcc, $subject, $body, $attachment);
        return $myMails->send();
    }

    private function sendEmailShipmentToTransport($parcelID,$centreInformation,$toWC,$ccDM)
    {
        $materialRequested=VMaterialsRequested::model()->find("PARCEL_ID=:PARCELID",array(":PARCELID"=>(int)$parcelID));
        if ($materialRequested != null)
            {
                $contact = VContactRegister::model()->find("USER_ID=:USERID",array(":USERID"=>(int)$materialRequested->USER_CONFIRM));
                $firstname=$contact->FIRSTNAME;
                $lastname=$contact->LASTNAME;
                $email=$contact->EMAIL;
                $phone= empty($contact->PHONE) ? "NA":$contact->PHONE;
                $fax= empty($contact->PHONE) ? "NA":$contact->FAX;
            }

        $country=$centreInformation->COUNTRY;
        $centre=$centreInformation->CENTRE;

        $attachment=array("temp/pdf/transport_$parcelID.pdf"=>"aphinity_transport_".$country."_".$centre."_".$parcelID.".pdf");
        $from="breast.translational@bordet.be";
        $fromName="breast translational";
        
        if (Yii::app()->params['environment'] <>'prod')
        {
            $toWC= array("ngocvu.tran@bordet.be");
            $ccDM=array();
        }

        $bcc=array("ngocvu.tran@bordet.be");

        $subject="Request of pickup for biological samples - $country - $centre - $parcelID";
        
        $pathToTemplateEmail= Yii::getPathOfAlias("application.modules.shipment.models.emails") ;
        if ('china'==strtolower($country))
            $emailTemplate= file_get_contents("$pathToTemplateEmail\\EmailShippingToWCChina.txt");
        else
            $emailTemplate= file_get_contents("$pathToTemplateEmail\\EmailShippingToWC.txt");
        
        $emailTemplate=str_replace("{account_number}", "477010", $emailTemplate);
        $emailTemplate=str_replace("{study_number}", "BO25126", $emailTemplate);
        $emailTemplate=str_replace("{centre}",$centreInformation->CENTRE , $emailTemplate);
        $emailTemplate=str_replace("{centre_name}", $centreInformation->INSTITUTION, $emailTemplate);
        $emailTemplate=str_replace("{address_street}", $centreInformation->ADDRESS, $emailTemplate);
        $emailTemplate=str_replace("{address_postcode}", $centreInformation->ZIP_CODE, $emailTemplate);
        $emailTemplate=str_replace("{address_city}", $centreInformation->CITY, $emailTemplate);
        $emailTemplate=str_replace("{country}", $centreInformation->COUNTRY, $emailTemplate);
        $emailTemplate=str_replace("{firstname}", $firstname, $emailTemplate);
        $emailTemplate=str_replace("{lastname}", $lastname, $emailTemplate);
        $emailTemplate=str_replace("{email}", $email, $emailTemplate);
        $emailTemplate=str_replace("{phone}", $phone, $emailTemplate);
        $emailTemplate=str_replace("{fax}", $fax, $emailTemplate);
        
        $body=utf8_decode($emailTemplate);

        $myMails = new MyMails ($from,$fromName, $toWC, $ccDM, $bcc, $subject, $body, $attachment);
        return $myMails->send();
    }

    private function sendEmailShipmentToSite($parcelID,$centreInformation,$toSite,$ccDM)
    {
        $country = $centreInformation->COUNTRY;
        $centre=$centreInformation->CENTRE;
        $study=$centreInformation->STUDY;
        $attachment=array("temp/pdf/shipment_$parcelID.pdf"=>"aphinity_shipment_".$country."_".$centre."_".$parcelID.".pdf");
        $from="breast.translational@bordet.be";
        $fromName="breast translational";

        $monitorAndPI = $this->getPIAndMonitor($centre);
        foreach ($monitorAndPI as $email)
            $ccDM[]=$email;

        if (Yii::app()->params['environment'] <>'prod')
        {
            $toSite=array("ngocvu.tran@bordet.be");
            $ccDM=array();
        }
        
        $bcc=array("ngocvu.tran@bordet.be");
        
        $pathToTemplateEmail= Yii::getPathOfAlias("application.modules.shipment.models.emails") ;
        $emailTemplate= file_get_contents("$pathToTemplateEmail\\EmailShippingToSite.txt");
        
        $subject="$study : Confirmation of pick up for biological samples - $country - $centre - $parcelID";
        $body=utf8_decode($emailTemplate);

        $myMails = new MyMails ($from,$fromName, $toSite, $ccDM, $bcc, $subject, $body, $attachment);
        return $myMails->send();
    }

    /**
     * Le nom est mal choisi, au départ il ne devait y a avoir que B&C comme unique study repository.  Mais évidemment ça n'a pas duré...
     * @param $parcelID
     * @param $centreInformation
     * @return bool
     */
    private function sendEmailToBnc($parcelID,$centreInformation)
    {
        $attachment=array();
        $from="breast.translational@bordet.be";
        $fromName="breast translational";
        $study=$centreInformation->STUDY;

        if ('china'==strtolower($centreInformation->COUNTRY))
            $to=array('QLC_SepcMan@quintiles.com');
        else
            $to=array(BNCEMAIL);
        
        if (Yii::app()->params['environment'] <>'prod')
                $to= array("ngocvu.tran@bordet.be");
        
        $bcc=array("ngocvu.tran@bordet.be");
        $subject="$study - Biological Sample Shipment : $centreInformation->COUNTRY - $centreInformation->CENTRE - $parcelID";
        
        $pathToTemplateEmail= Yii::getPathOfAlias("application.modules.shipment.models.emails") ;
        $emailTemplate= file_get_contents("$pathToTemplateEmail\\EmailShippingToBC.txt");
        $emailTemplate=str_replace("{country}", $centreInformation->COUNTRY, $emailTemplate);
        $emailTemplate=str_replace("{centre_name}", $centreInformation->INSTITUTION, $emailTemplate);
        $emailTemplate=str_replace("{centre}", $centreInformation->CENTRE, $emailTemplate);
        $emailTemplate=str_replace("{parcel_id}", $parcelID, $emailTemplate);
        
        $body=utf8_decode($emailTemplate);

        $myMails = new MyMails ($from,$fromName, $to, array(), $bcc, $subject, $body, $attachment);
        return $myMails->send();
    }
    
    /*return array */
    private function getPIAndMonitor($centre)
    {
        $valueToReturn = array();
        $clinConn = Yii::app()->db; 
        // Here you will use your complex sql query using a string or other yii ways to create your query
        $sql="SELECT EMAIL FROM CONTACTS.V_CONTACTS_AlL_EXCEPT_HERA WHERE (ROLE_NAME LIKE 'PRINCIPAL INVESTIGATOR' OR ROLE_NAME LIKE '%MONITOR%') AND CENTRE=:CENTRE ";
        $oCommand = $clinConn->createCommand($sql);
        // Bind the parameter
        $oCommand->bindParam(':CENTRE', $centre, PDO::PARAM_STR);
        $rows = $oCommand->queryAll(); // Run query and get all results
        foreach ($rows as $row)
            $valueToReturn[]=strtolower($row["EMAIL"]);
        
        return $valueToReturn;
    }
    
}

?>
