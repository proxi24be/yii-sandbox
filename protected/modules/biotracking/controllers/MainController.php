<?php

require_once ("BiotrackingAbstractController.php");
require_once("custom/MySample.php");

class MainController extends BiotrackingAbstractController
{
    public function actionIndex()
    {
        $this->render("index");
    }
    
    public function actionFaq()
    {
        $this->render("faq");
    }
    
    public function actionContactUs()
    {
        $this->render("contactus");
    }
    
    public function actionMySamples()
    {
        $studyID=Yii::app()->user->selectedStudy;
        $mySample=new MySample();
        $visits=$mySample->getMyVisits($studyID, Yii::app()->user->id);
        
        //construction des liens ajax
        for ($i=0 ; $i<count($visits);$i++)
        {
            $visitName=$visits[$i]["VISIT_NAME"];
            $visits[$i]["href"]="/biotracking/main/getTableForVisit?index=$i";
            $visits[$i]["a"]=$visitName;
        }

        $max=count($visits);
        $visits[$max]["href"]="/biotracking/main/getTableForVisit?index=$max";

        //ajout de ALL VISITS
        $visits[$max]["VISIT_NAME"]="ALL VISITS";
        $visits[$max]["a"]="ALL VISITS";
        
        //ajout artificiel de la visit PK
        $visits[$max+1]["VISIT_NAME"]="PK VISIT";
        $visits[$max+1]["a"]="PK SAMPLES";
        
        $this->render("mySamples", array("visits"=>$visits));
    }
    
    public function actionGetTableForVisit($index)
    {
        //   il existe certainement une autre façon de procéder mais ça deviendrait un peu de 
        // chipotage >>> il faudrait changer l'event du composant tab de jquery-ui
        echo "<table cellpadding='0' cellspacing='0' border='0' id='myVisit_$index'></table>";
    }
    
    public function actionSampleByVisit($visitName)
    {
        $studyID=Yii::app()->user->selectedStudy;
        $mySample=new MySample();
        
        if ($visitName=="ALL VISITS")
            $rows=$mySample->getMySamples($studyID, Yii::app()->user->id);
         else   
             $rows=$mySample->getMySamples($studyID,Yii::app()->user->id,"VISIT_NAME='$visitName'");
         
         echo CJSON::encode($rows);
    }
    
    public function actionSampleCompletedForm()
    {
        $tab[]= array("a"=>"Tissue for HER2 screening","href"=>"/biotracking/main/sampleCompletedFormTissue");
        $tab[]= array("a"=>"Other samples","href"=>"/biotracking/main/sampleCompletedFormOther");
        
        $this->render("sampleCompletedForm",array("tab"=>$tab));
    }
    
    public function actionSampleCompletedFormTissue()
    {
        $studyID=Yii::app()->user->selectedStudy;
        $mySample=new MySample();
        $rows = $mySample->getSampleCompletedFormTissue($studyID, Yii::app()->user->id,Yii::app()->user->profile);
        $this->renderPartial("sampleCompletedFormTissue",array("jsonData"=>$rows));
    }
    
    public function actionSampleCompletedFormOther()
    {
        $studyID=Yii::app()->user->selectedStudy;
        $mySample=new MySample();
        $rows = $mySample->getSampleCompletedFormOther($studyID, Yii::app()->user->id,Yii::app()->user->profile);
        $this->renderPartial("sampleCompletedFormOther",array("jsonData"=>$rows));
    }
}
