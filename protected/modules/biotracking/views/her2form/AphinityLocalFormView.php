<?php 
    
    $biotrackingCSS=Yii::getPathOfAlias("webroot.css.biotracking");
    $assertCSS = Yii::app()->assetManager->publish($biotrackingCSS); 
    Yii::app()->clientScript->registerCSSFile("$assertCSS/redmond/redmond.css" );
    
    $jquery=Yii::getPathOfAlias("webroot.javascript");
    $assert = Yii::app()->assetManager->publish($jquery); 
    Yii::app()->clientScript->registerScriptFile("$assert/jquery-1.8.2.min.js" );
    
    $jqueryUI=Yii::getPathOfAlias("webroot.javascript.jquery-ui");
    $assertJqueryUI = Yii::app()->assetManager->publish($jqueryUI); 
    Yii::app()->clientScript->registerScriptFile("$assertJqueryUI/jquery-ui-1.9.0.min.js" );
    
    $biotrackingScript=Yii::getPathOfAlias("webroot.javascript.biotracking");
    $assert = Yii::app()->assetManager->publish($biotrackingScript); 
    Yii::app()->clientScript->registerScriptFile("$assert/AphinityToolTip.js" );
    Yii::app()->clientScript->registerScriptFile("$assert/AphinityValidationRule.js" );
    
    $commonScript=Yii::getPathOfAlias("webroot.javascript");
    $assert = Yii::app()->assetManager->publish($commonScript); 
    Yii::app()->clientScript->registerScriptFile("$assert/CutoffValue.js" );
    
    $baseUrl = Yii::app()->request->baseUrl;
    
    function returnNAIfEmpty($value)
    {
        if (isset($value))
            return empty($value)?"NA":$value;
        else
            return "NA";
    }
?>

<style>
    
    fieldset ul , fieldset li
    {
        list-style:none;
    }
    
    fieldset div.oneQuestion
    {
        margin-bottom:10px;
    }
    
    fieldset div.oneQuestion li
    {
        float :left;
        margin-right:10px;
    }
    
    fieldset li.question
    {
        width:350px;
        text-align: right;
        font-weight: bold;
    }
    
    fieldset li.myContent label
    {
        display:inline;
        margin-right:10px;
        font-weight: normal;
    }
    
    ul.byDefaultHidden, li.otherStaining, li.ISHKitOther, li.IHCLocalGuidelinesNA, li.IHCCellPos,li.ISHSingleAmplifiedOrNotGeneCopy,
    li.ISHSingleAmplifiedOrNotOtherSpecify, li.percInvStaining{
        display:none;
    }
    
    ul.separator
    {
        border-style: dashed ;
        border-color: #599bdc;
        border-width: 2px;
    }
    
    div.form div.errorMessage
    {
        margin-left:0;
    }
    
    ul.mainTest li.question
    {
        width:270px;
    }
    
    ul.mainTest li.question label
    {
        font-style: italic;
        font-size: 1em;
    }
    
    .marginTop_5
    {
        margin-top:5px;
    }
    
    h3.title
    {
        text-align: right;
    }
    .warningTooltip
    {
        font-size: 80%;
    }
    li.warningTooltip
    {
        background-color: #fbf9ee;
        border: 1px solid orange;
        padding:5px;
    }
    .ui-tooltip
    {
        width:240px;
        font-size: 75%;
    }
    
    div.generalInformation  div.block1
    {
        font-size: x-large;
        color:navy;
        font-family: 'Lucida Grande',Verdana,Arial,sans-serif;
    }
    
    div.generalInformation p 
    {
        color:#3C8FA7;
        font-weight: bold;
        text-decoration: underline;
    }
    
    div.scientistInfo
    {
        background-color: #fbf9ee;
        padding:5px;
        margin-top:10px;
        width: 300px;
    }
    
    div.localResult 
    {
        padding:5px;
        margin-top:10px;
        width: 300px;
    }
    
    div.generalInformation li label
    {
        width:150px;
        float:left;
        display:block;
        text-align: right;
        margin-right:5px;
        font-weight: bold;
    }
    div.col1 li label
    {
        width:50px;
    }
    
    div.tissueGeneralInformation
    {
        background-color: #EEF5F7;
    }
    div.tissueGeneralInformation div, div.tissueGeneralInformation p, div.tissueGeneralInformation ul
    {
        padding:10px;
    }
    
    div.tissueGeneralInformation p
    {
        margin:0;
    }
    
    hr.newTest
    {
        margin-top:15px;
        margin-bottom:15px;
    }
    
    div.groupTest:hover
    {
        background-color:ghostwhite;
        padding-top:5px;
        padding-bottom:5px;
    }
 
    div span label
    {position: relative; zoom: 1;}
    
    span#AphinityLocalForm_IHCPositivity label
    {
        font-size: 75%;
    }
</style>

<div class="container_12">
    <div class="grid_12 header">
        <h2 style="vertical-align: middle;text-align: center">APHINITY STUDY <img src="<?php echo $baseUrl;?>/images/aphinity_logo.png" width="50"> </h2>
    </div>    
</div>

<div class="container_12 generalInformation">
    
    <div class="grid_12 tissueGeneralInformation">
        <div class="block1 grid_4">Tissue block general information</div>
    </div>
    
    <div class="grid_4 col1">
    <div class="scientistInfo" >
        <p>Principal investigator info</p>
        <ul>
            <li><label>Name</label><?php echo returnNAIfEmpty($contactInfo->CONTACT_PERSON);?></li>
            <li><label>Fax</label><?php echo returnNAIfEmpty($contactInfo->FAX_NUMBER);?></li>
            <li><label>Email</label><?php echo returnNAIfEmpty($contactInfo->EMAIL);?></li>
        </ul>
    </div>
    
    <div class="scientistInfo">
        <p>Pathologist info</p>
        <ul>
            <li><label>Name</label><?php echo returnNAIfEmpty("$contactInfo->CONTACT_FORENAME $contactInfo->CONTACT_LASTNAME");?></li>
            <li><label>Phone</label><?php echo returnNAIfEmpty($contactInfo->CONTACT_PHONE);?></li>
            <li><label>Fax</label><?php echo  returnNAIfEmpty($contactInfo->CONTACT_FAX);?></li>
            <li><label>Email</label><?php echo returnNAIfEmpty($contactInfo->CONTACT_EMAIL);?></li>
        </ul>
    </div>
        
    <div class="tissueGeneralInformation localResult">
        <div class="block1">Tissue local result</div>
    </div>
        
    </div>
    
    <div class="grid_8 omega tissueGeneralInformation">
        <p>Centre info</p>
        <ul>
            <li><label>Centre name</label><?php echo returnNAIfEmpty($contactInfo->CENTRE_NAME);?></li>
            <li><label>Centre number</label><?php echo returnNAIfEmpty($contactInfo->SHORT_DESCRIPTION);?></li>
        </ul>
        
        <p>Sample info</p>
        <ul>
            <li><label>Patient screening number</label><?php echo returnNAIfEmpty("");?></li>
            <li><label>Sample type</label><?php echo returnNAIfEmpty($contactInfo->MATERIAL_TYPE);?></li>
            <li><label>Local pathological ID</label><?php echo returnNAIfEmpty($contactInfo->LOCAL_ID);?></li>
            <li><label>Laterality</label><?php echo returnNAIfEmpty($contactInfo->LATERALITY);?></li>
            <li><label>Fixative used</label><?php echo returnNAIfEmpty($contactInfo->FIXATIVES);?></li>
            <li><label>Collection date</label><?php echo returnNAIfEmpty($contactInfo->COLLECTION_DATE);?></li>
        </ul>
        
        <p>Return address for FFPE tumor block</p>
        <ul>
            <li><label>Street</label><?php echo returnNAIfEmpty($contactInfo->ADDRESS_STREET);?></li>
            <li><label>Postcode</label><?php echo returnNAIfEmpty($contactInfo->ADDRESS_POSTCODE);?></li>
            <li><label>City</label><?php echo returnNAIfEmpty($contactInfo->ADDRESS_CITY);?></li>
        </ul>
    </div>
    
</div>

<div class="clear"></div>

<div class="" style="margin-top:10px">

<div class="form">
<?php 

$form=$this->beginWidget('CActiveForm', array(
        'id'=>'AphinityLocalForm',
        'enableClientValidation'=>false,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
        ),
        // 'action'=>$url
)); 

echo $form->hiddenField($aphinityLocalForm,'update',array("value"=>$aphinityLocalForm->update)); 
echo $form->error($aphinityLocalForm,'update');
?>
    
<fieldset class="container_12">
    
<p class="grid_12"><b><u>Shipment</u></b>:(Please send only <u>one tumor block</u> and make sure it includes at least 5mm of the invasive component of <u>the primary breast cancer</u>)</p>

<ul>
    <div class="oneQuestion grid_11 push_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,'pathologicalStage'); ?></li>
    <li class="response">
    <?php 
        echo $form->dropDownList($aphinityLocalForm,'pathologicalStage', HelperForm::getArray($values,221,true), 
                array("separator"=>"","class"=>"typeTest")); 
        echo $form->error($aphinityLocalForm,'pathologicalStage');
    ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><label>For guidance on the TNM staging classification</label></li>
        <li class="response"><a target="_blank" href="http://www.cancer.gov/cancertopics/pdq/treatment/breast/Patient/page2#Keypoint12">Visit this page</a></li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,'sizeInvComp'); ?></li>
    <li class="response">
    <?php 
        echo $form->textField($aphinityLocalForm,'sizeInvComp',array("size"=>"3")) . " mm"; 
        echo $form->error($aphinityLocalForm,'sizeInvComp');
    ?>
    </li>
    </div>
</ul>

<div class="push_3 grid_5 ">
    <hr class="newTest"/>
</div>

<div class="clear"></div>  

<div class="groupTest grid_12">
    
<h3 class="title grid_5" >Immunohistochemistry (IHC)</h3>    
    
<!--  IHC TEST  -->
<ul class="mainTest">
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,'IHCPerformed'); ?></li>
    <li class="response">
    <?php 
        echo $form->radioButtonList($aphinityLocalForm,'IHCPerformed', HelperForm::getArray($values,222), 
                array("separator"=>"","class"=>"typeTest")); 
        echo $form->error($aphinityLocalForm,'IHCPerformed');
    ?>
    </li>
    </div>
</ul>
<ul class="aphinityIHC byDefaultHidden">
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,'IHCTestDate'); ?></li>
        <li class="response">
            <?php 
                echo $form->textField($aphinityLocalForm,'IHCTestDate',array("size"=>"10","class"=>"testDate")); 
                echo $form->error($aphinityLocalForm,'IHCTestDate',array("size"=>"10"));
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,'IHCResult'); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'IHCResult', HelperForm::getArray($values,12),array("separator"=>"")); 
                echo $form->error($aphinityLocalForm,'IHCResult'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question percInvStaining"><?php echo $form->label($aphinityLocalForm,'percInvStaining'); ?></li>
        <li class="response percInvStaining">
            <?php 
                echo $form->textField($aphinityLocalForm,'percInvStaining',array("size"=>"3")); 
                echo $form->error($aphinityLocalForm,'percInvStaining'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,'stainingAntibody'); ?></li>
    <li class="response">
        <?php 
            echo $form->dropDownList($aphinityLocalForm,'stainingAntibody',HelperForm::getArray($values,225,true)); 
            echo $form->error($aphinityLocalForm,'stainingAntibody'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question otherStaining"><?php echo $form->label($aphinityLocalForm,'stainingAntibodyOther'); ?></li>
        <li class="response otherStaining">
            <?php 
                echo $form->textField($aphinityLocalForm,'stainingAntibodyOther',array("size"=>"10")); 
                echo $form->error($aphinityLocalForm,'stainingAntibodyOther'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,'IHCLocalGuidelines'); ?></li>
        <li class="response">
            <?php 
                echo $form->dropDownList($aphinityLocalForm,'IHCLocalGuidelines',HelperForm::getArray($values,227,true)); 
                echo $form->error($aphinityLocalForm,'IHCLocalGuidelines'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question IHCLocalGuidelinesNA"><?php echo $form->label($aphinityLocalForm,'IHCLocalGuidelinesNA'); ?></li>
    <li class="response IHCLocalGuidelinesNA">
        <?php 
            echo $form->dropDownList($aphinityLocalForm,'IHCLocalGuidelinesNA',HelperForm::getArray($values,228,true)); 
            echo $form->error($aphinityLocalForm,'IHCLocalGuidelinesNA'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,'IHCPositivity'); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'IHCPositivity',HelperForm::getArray($values,229)); 
                echo $form->error($aphinityLocalForm,'IHCPositivity'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question IHCCellPos"><?php echo $form->label($aphinityLocalForm,"IHCCellPos"); ?></li>
        <li class="response IHCCellPos">
            <?php 
                echo $form->textField($aphinityLocalForm,'IHCCellPos',array("size"=>"5")); 
                echo $form->error($aphinityLocalForm,'IHCCellPos'); 
            ?>
        </li>
    </div>
</ul>

</div> <!-- groupTest -->

<div class="push_3 grid_5 ">
    <hr class="newTest"/>
</div>

<div class="clear"></div>

<div class="groupTest grid_12">

<h3 class="title grid_5">HER2 ISH dual colour (dual probe)</h3>

<ul class="mainTest">
<!--  ISH DUAL COLOUR TEST  -->
<div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHDualPerformed"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'ISHDualPerformed', HelperForm::getArray($values,220), array("separator"=>"","class"=>"typeTest")
                    ); 
            echo $form->error($aphinityLocalForm,'ISHDualPerformed'); 
        ?>
    </li>
</div>
</ul>

<ul class="aphinityISHDualColour byDefaultHidden">
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHDualTestDate"); ?></li>
        <li class="response">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHDualTestDate',array("size"=>"10","class"=>"testDate")); 
                echo $form->error($aphinityLocalForm,'ISHDualTestDate',array("size"=>"10")); 
            ?>
        </li>
    </div>

    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHKit"); ?></li>
    <li class="response">
        <?php 
            echo $form->dropDownList($aphinityLocalForm,'ISHKit',HelperForm::getArray($values,232,true)); 
            echo $form->error($aphinityLocalForm,'ISHKit'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question ISHKitOther"><?php echo $form->label($aphinityLocalForm,"ISHKitOther"); ?></li>
    <li class="response ISHKitOther">
        <?php 
            echo $form->textField($aphinityLocalForm,'ISHKitOther',array("size"=>"40")); 
            echo $form->error($aphinityLocalForm,'ISHKitOther'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHDualResult"); ?></li>
    <li class="response">
        <?php 
            echo $form->dropDownList($aphinityLocalForm,'ISHDualResult',HelperForm::getArray($values,234,true)); 
            echo $form->error($aphinityLocalForm,'ISHDualResult'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><label>Dual colour ISH HER2/neu/Chromosome 17 ratio</label></li>
    <li class="response">
        <?php 
            echo $form->textField($aphinityLocalForm,'ISHDual17RatioUnit',array("size"=>"2"));
            echo $form->error($aphinityLocalForm,'ISHDual17RatioUnit'); 
            echo $form->textField($aphinityLocalForm,'ISHDual17RatioDecimal',array("size"=>"2")); 
            echo $form->error($aphinityLocalForm,'ISHDual17RatioDecimal'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHDualGeneCopyNumber"); ?></li>
    <li class="response">
        <?php 
            echo $form->textField($aphinityLocalForm,'ISHDualGeneCopyNumber',array("size"=>"2"));
            echo $form->error($aphinityLocalForm,'ISHDualGeneCopyNumber'); 
        ?>
    </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
    <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHDual17CopyNumber"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'ISHDual17CopyNumber',HelperForm::getArray($values,238)); 
            echo $form->error($aphinityLocalForm,'ISHDual17CopyNumber'); 
        ?>
    </li>
    </div>
</ul>

</div> <!--end group test-->

<div class="push_3 grid_5 ">
    <hr class="newTest"/>
</div>
<div class="clear"></div>

<div class="groupTest grid_12">

<h3 class="title grid_5">HER2 ISH single colour (single probe)</h3>

<!--  ISH SINGLE COLOUR TEST  -->
<ul class="mainTest">
<div class="oneQuestion grid_11 prefix_1">
    <li class="question" ><?php echo $form->label($aphinityLocalForm,"ISHSinglePerformed"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'ISHSinglePerformed', HelperForm::getArray($values,242), array("separator"=>"","class"=>"typeTest")); 
            echo $form->error($aphinityLocalForm,'ISHSinglePerformed'); 
        ?>
    </li>
</div>
</ul>

<ul class="aphinityISHSingleColour byDefaultHidden">
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleTestDate"); ?></li>
        <li class="response">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHSingleTestDate',array("size"=>"10","class"=>"testDate")); 
                echo $form->error($aphinityLocalForm,'ISHSingleTestDate',array("size"=>"10")); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleMethod"); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'ISHSingleMethod',HelperForm::getArray($values,244)); 
                echo $form->error($aphinityLocalForm,'ISHSingleMethod'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleKit"); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'ISHSingleKit',HelperForm::getArray($values,245)); 
                echo $form->error($aphinityLocalForm,'ISHSingleKit'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleKitCommercial"); ?></li>
        <li class="response">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHSingleKitCommercial',array("size"=>"10"));
                echo $form->error($aphinityLocalForm,'ISHSingleKitCommercial'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question" ><?php echo $form->label($aphinityLocalForm,"ISHSingleResult"); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'ISHSingleResult',HelperForm::getArray($values,247)); 
                echo $form->error($aphinityLocalForm,'ISHSingleResult'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleGeneCopyNumber"); ?></li>
        <li class="response">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHSingleGeneCopyNumber',array("size"=>"10"));
                echo $form->error($aphinityLocalForm,'ISHSingleGeneCopyNumber'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question"><?php echo $form->label($aphinityLocalForm,"ISHSingleAmplifiedOrNot"); ?></li>
        <li class="response">
            <?php 
                echo $form->radioButtonList($aphinityLocalForm,'ISHSingleAmplifiedOrNot',HelperForm::getArray($values,249)); 
                echo $form->error($aphinityLocalForm,'ISHSingleAmplifiedOrNot'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question ISHSingleAmplifiedOrNotGeneCopy"><?php echo $form->label($aphinityLocalForm,"ISHSingleAmplifiedOrNotGeneCopy"); ?></li>
        <li class="response ISHSingleAmplifiedOrNotGeneCopy">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHSingleAmplifiedOrNotGeneCopy',array("size"=>"3"));
                echo $form->error($aphinityLocalForm,'ISHSingleAmplifiedOrNotGeneCopy'); 
            ?>
        </li>
    </div>
    
    <div class="oneQuestion grid_11 prefix_1">
        <li class="question ISHSingleAmplifiedOrNotOtherSpecify marginTop_5"><?php echo $form->label($aphinityLocalForm,"ISHSingleAmplifiedOrNotOtherSpecify"); ?></li>
        <li class="response ISHSingleAmplifiedOrNotOtherSpecify">
            <?php 
                echo $form->textField($aphinityLocalForm,'ISHSingleAmplifiedOrNotOtherSpecify',array("size"=>"30"));
                echo $form->error($aphinityLocalForm,'ISHSingleAmplifiedOrNotOtherSpecify'); 
            ?>
        </li>
    </div>
</ul>

</div> <!--end group test-->

<div class="push_3 grid_5 ">
    <hr class="newTest"/>
</div>
<div class="clear"></div>  

<ul class="mainTest">
<div class="oneQuestion grid_11 prefix_1">
    <li class="question" ><?php echo $form->label($aphinityLocalForm,"localReceptorER"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'localReceptorER', HelperForm::getArray($values,82), array("separator"=>"","class"=>"typeTest")); 
            echo $form->error($aphinityLocalForm,'localReceptorER'); 
        ?>
    </li>
</div>
<div class="oneQuestion grid_11 prefix_1">
    <li class="question" ><?php echo $form->label($aphinityLocalForm,"localReceptorPGR"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'localReceptorPGR', HelperForm::getArray($values,83), array("separator"=>"","class"=>"typeTest")); 
            echo $form->error($aphinityLocalForm,'localReceptorPGR'); 
        ?>
    </li>
</div>
</ul>

<ul class="mainTest">
<div class="oneQuestion grid_11 prefix_1">
    <li class="question" ><?php echo $form->label($aphinityLocalForm,"localComment"); ?></li>
    <li class="response">
        <?php 
            echo $form->textArea($aphinityLocalForm,'localComment', array("rows"=>"5","cols"=>"35")); 
            echo $form->error($aphinityLocalForm,'localComment'); 
        ?>
    </li>
</div>
<div class="oneQuestion grid_11 prefix_1">
    <li class="question" ><?php echo $form->label($aphinityLocalForm,"localPathologistSigned"); ?></li>
    <li class="response">
        <?php 
            echo $form->radioButtonList($aphinityLocalForm,'localPathologistSigned', HelperForm::getArray($values,57), array("separator"=>"","class"=>"typeTest")); 
            echo $form->error($aphinityLocalForm,'localPathologistSigned'); 
        ?>
    </li>
</div>
</ul>

</fieldset>

<ul class="actionUserGroup">
    <li><?php echo CHtml::submitButton($labelSubmit,array("class"=>"submitButton","style"=>"margin-left:40%")); ?></li>
</ul>
    
<?php $this->endWidget(); ?>
    
<p>Print the form to include in the package to the Central Lab</p>

</div><!-- container -->

</div> <!--grid_12-->
    
<script type="text/javascript">
    
var conditionalValue=
{
    AphinityLocalForm_IHCResult:{event:"click",checkValue:["3+"],display:".percInvStaining"},
    AphinityLocalForm_stainingAntibody:{event:"change",checkValue:["other"],display:".otherStaining"},
    AphinityLocalForm_IHCLocalGuidelines:{event:"change",checkValue:["not available"],display:".IHCLocalGuidelinesNA"},
    AphinityLocalForm_IHCPositivity:{event:"click",checkValue:["approved label (complete membrane staining in >10% of tumor cells)","asco/cap guidelines (complete membrane staining in >30% of tumor cells)"],display:".IHCCellPos"},
    AphinityLocalForm_ISHKit:{event:"change",checkValue:["other commercial ish test"],display:".ISHKitOther"},
    AphinityLocalForm_ISHSingleAmplifiedOrNot:{event:"click",checkValue:["assay label (her2 gene copy > _ 4 or 5 or 6)","other"],
        display:[".ISHSingleAmplifiedOrNotGeneCopy",".ISHSingleAmplifiedOrNotOtherSpecify"]}
}
    
var AphinityLocalForm={
    init : function()
    {
        AphinityLocalForm.setQuestionToDisplay();
        AphinityLocalForm.setTypeTestEvent();
        AphinityLocalForm.setConditionalResponse();
        AphinityLocalForm.checkConditionalResponseToDisplay();
    },
    
    setQuestionToDisplay: function()
    {
       $("#AphinityLocalForm").find(".typeTest").each(function()
       {
            if ($(this).prop("checked"))
            {
                if ($(this).val()=='Yes')
                    AphinityLocalForm.checkElementToDisplay(this);
                else
                    AphinityLocalForm.checkElementToHide(this);
            }
       });
    },
    
    setTypeTestEvent:function()
    {
        $("#AphinityLocalForm").delegate(".typeTest","change",function()
        {
           if ($(this).attr("name")=='AphinityLocalForm[IHCPerformed]')
               {
                    if ($(this).val()=='Yes')
                        AphinityLocalForm.displayGroupQuestion(".aphinityIHC");
                    else
                        AphinityLocalForm.hideGroupQuestion(".aphinityIHC");
               }
               
           else if ($(this).attr("name")=='AphinityLocalForm[ISHDualPerformed]')
               {
                    if ($(this).val()=='Yes')
                        AphinityLocalForm.displayGroupQuestion(".aphinityISHDualColour");
                    else
                        AphinityLocalForm.hideGroupQuestion(".aphinityISHDualColour");
               }
               
          else if ($(this).attr("name")=='AphinityLocalForm[ISHSinglePerformed]')
               {
                    if ($(this).val()=='Yes')
                        AphinityLocalForm.displayGroupQuestion(".aphinityISHSingleColour");
                    else
                        AphinityLocalForm.hideGroupQuestion(".aphinityISHSingleColour");
               }
               
          else;
               
        });
    },
    
    displayGroupQuestion: function(questionClass)
    {
        $("#AphinityLocalForm").find(questionClass).css({"display":"block"});
    },
    
    hideGroupQuestion: function(questionClass)
    {
        $("#AphinityLocalForm").find(questionClass).css({"display":"none"});
    },
    checkElementToHide: function(currElem)
    {
        if ($(currElem).attr("name")=='AphinityLocalForm[IHCPerformed]')
            AphinityLocalForm.hideGroupQuestion('.aphinityIHC');

        else if ($(currElem).attr("name")=='AphinityLocalForm[ISHDualPerformed]')
            AphinityLocalForm.hideGroupQuestion('.aphinityISHDualColour');
        else if ($(currElem).attr("name")=='AphinityLocalForm[ISHSinglePerformed]')
            AphinityLocalForm.hideGroupQuestion('.aphinityISHSingleColour');

        else;
    },
    
    checkElementToDisplay: function(currElem)
    {
        if ($(currElem).attr("name")=='AphinityLocalForm[IHCPerformed]')
            AphinityLocalForm.displayGroupQuestion(".aphinityIHC");

        else if ($(currElem).attr("name")=='AphinityLocalForm[ISHDualPerformed]')
            AphinityLocalForm.displayGroupQuestion(".aphinityISHDualColour");

        else if ($(currElem).attr("name")=='AphinityLocalForm[ISHSinglePerformed]')
            AphinityLocalForm.displayGroupQuestion(".aphinityISHSingleColour");

        else;
    },
    
    setConditionalResponse: function()
    {
        for (var condition in conditionalValue)
        {
            try
            {
                $("#"+condition).on(conditionalValue[condition].event,function(event){
                    // il doit exister une façon plus élégante de faire le meme traitement...
                    var id = $(this).attr("id");
                    var currentVal="";
                    if (conditionalValue[id].event=='click')
                        currentVal=$(this).find("input[type='radio']:checked").val();
                    else 
                        currentVal=$(this).find("option:selected").text();

                    if (id!='AphinityLocalForm_ISHSingleAmplifiedOrNot')
                    {
                        if ( $.inArray(currentVal.toLowerCase(),conditionalValue[id].checkValue)!=-1 )
                                AphinityLocalForm.displayGroupQuestion(conditionalValue[id].display);
                        else
                                AphinityLocalForm.hideGroupQuestion(conditionalValue[id].display);
                    }
                    else //AphinityLocalForm_ISHSingleAmplifiedOrNot
                    {  
                        if (currentVal.toLowerCase()==conditionalValue[id].checkValue[0])
                                AphinityLocalForm.displayGroupQuestion(conditionalValue[id].display[0]);
                        else
                                AphinityLocalForm.hideGroupQuestion(conditionalValue[id].display[0]);

                        if (currentVal.toLowerCase()==conditionalValue[id].checkValue[1])
                                AphinityLocalForm.displayGroupQuestion(conditionalValue[id].display[1]);
                        else
                                AphinityLocalForm.hideGroupQuestion(conditionalValue[id].display[1]);
                    }
                }); 
            }
            
            catch (err)
            {
                ;
            }
            
        }
    },
    
    checkConditionalResponseToDisplay:function()
    {
        for(var condition in conditionalValue)
        {
            try
            {
                var id = "#"+condition; 
                var currentVal="";
                if (conditionalValue[condition].event=='click')
                    currentVal=$(id).find("input[type='radio']:checked").val();
                else 
                    currentVal=$(id).find("option:selected").text();

                if (condition != 'AphinityLocalForm_ISHSingleAmplifiedOrNot')
                {
                    if ($.inArray(currentVal.toLowerCase(),conditionalValue[condition].checkValue)!=-1)
                           AphinityLocalForm.displayGroupQuestion(conditionalValue[condition].display);
                }
                else 
                {
                    if (currentVal.toLowerCase()==conditionalValue[condition].checkValue[0])
                            AphinityLocalForm.displayGroupQuestion(conditionalValue[condition].display[0]);
                    else
                            AphinityLocalForm.hideGroupQuestion(conditionalValue[condition].display[0]);

                    if (currentVal.toLowerCase()==conditionalValue[condition].checkValue[1])
                            AphinityLocalForm.displayGroupQuestion(conditionalValue[condition].display[1]);
                    else
                            AphinityLocalForm.hideGroupQuestion(conditionalValue[condition].display[1]);
                }
            }
            catch (err)
            {
                ;
            }
        }
    }
};

$(document).ready(function(){
	var urlCalendar="<?php echo Yii::app()->baseUrl;?>" + "/images/tools/cal.gif";
        AphinityLocalForm.init();
        $( "input.testDate" ).datepicker(
        {
            showOn: "button",
            buttonImage: urlCalendar,
            buttonImageOnly: true,
            changeMonth:true,
            maxDate:'today'
        });
        
        $( "input.testDate" ).attr("readonly","readonly");
        AphinityToolTip.init();
        AphinityValidationRule.setValidationRule();
        AphinityValidationRule.displayAllWarningMessage();
});

</script>



    


