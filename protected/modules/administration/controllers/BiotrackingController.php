<?php

require_once('AdminAbstractController.php');

class BiotrackingController extends AdminAbstractController
{
    public function actionLocalForm()
    {
         Yii::beginProfile("maintenance localform");
         $urlIframeLocalForm="";
         $sampleID=0;
         if (isset($_POST["SAMPLE_ID"]))
         {
             $sampleID=$_POST["SAMPLE_ID"];
             $absoluteUrl= Yii::app()->createAbsoluteUrl("biotracking/her2form/localForm");
             $urlIframeLocalForm="$absoluteUrl?sampleID=$sampleID";
         }
         
         $this->render("localform",array("urlIframeLocalForm"=>$urlIframeLocalForm,"sampleID"=>$sampleID));
         Yii::endProfile("maintenance localform");
    }
    
}