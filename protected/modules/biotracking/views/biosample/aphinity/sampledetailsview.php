<style>

    form label
    {
        font-weight: bold;
    }

    span.spanInfo
    {
        padding:5px 0;
        margin-left:0px;
    }

    div.notEditableContent .control-group {
        margin-bottom: 0;
    }

</style>

<?php

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'SampleFormDetails',
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    "htmlOptions"=>array("class"=>"form-horizontal")
    // 'action'=>$url
));

?>
<div class="notEditableContent">

    <div class='control-group'>
        <?php echo $form->label($model,"patientNumber",array("class"=>"control-label"));?>
        <div class='controls'>
            <?php echo "<span class='spanInfo'>$model->patientNumber</span>";?>
        </div>
    </div>

    <div class='control-group'>
        <?php echo $form->label($model,"birthdate_dd_mmm_yyyy",array("class"=>"control-label")); ?>
        <div class='controls'>
            <?php echo "<span class='spanInfo'>$model->birthdate_dd_mmm_yyyy</span>";?>
        </div>
    </div>

    <div class='control-group'>
        <?php echo $form->label($model,"center",array("class"=>"control-label"));?>
        <div class='controls'>
            <?php echo "<span class='spanInfo'>$model->center</span>";?>
        </div>
    </div>

    <div class='control-group'>
        <?php echo $form->label($model,"visitName",array("class"=>"control-label"));?>
        <div class='controls'>
            <?php echo "<span class='spanInfo'>$model->visitName</span>";?>
        </div>
    </div>

    <div class='control-group'>
        <?php echo $form->label($model,"sampleType",array("class"=>"control-label"));?>
        <div class='controls'>
            <?php echo "<span class='spanInfo'>$model->sampleType</span>";?>
        </div>
    </div>

    <!-- test screening visit -->
    <?php if ("SCREENING"==$model->visitName):?>
        <div class='control-group'>
            <?php echo $form->label($model,"CONDITIONING",array("class"=>"control-label")); ?>
            <div class='controls'>
                <?php echo "<span class='spanInfo'>$model->CONDITIONING</span>";?>
            </div>
        </div>

        <div class='control-group'>
            <?php echo $form->label($model,"LATERALITY",array("class"=>"control-label")); ?>
            <div class='controls'>
                <?php echo "<span class='spanInfo'>$model->LATERALITY</span>";?>
            </div>
        </div>
    <?php endif;?>

</div>

<hr>


<div class='control-group'>
    <?php echo $form->label($model,"LOCAL_ID",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"LOCAL_ID");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"CRYOVIALS_NUMBER",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"CRYOVIALS_NUMBER",array("class"=>"input-mini"));?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"WITHDRAWAL_TIME",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"WITHDRAWAL_TIME");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"TEMPERATURE",array("class"=>"control-label")); ?>
    <div class='controls'>
        <div class="radio">
        <?php echo $form->radioButtonList($model,"TEMPERATURE",$temperatureList,array("separator"=>""));?>
        </div>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"COLLECTION_DATE_DD_MM_YYYY",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"COLLECTION_DATE_DD_MM_YYYY");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"FIXATIVES",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->dropDownList($model,"FIXATIVES",CHtml::listData($sampleFixatives,"GENERIC_VALUE","GENERIC_VALUE"));?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"OTHER_FREEZING_PROCEDURE",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"OTHER_FREEZING_PROCEDURE");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"MATERIAL_STATE",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->dropDownList($model,"MATERIAL_STATE",CHtml::listData($sampleStates,"GENERIC_VALUE","GENERIC_VALUE"));?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"COMMENT",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textArea($model,"COMMENT", array("rows"=>"4","cols"=>"40"));?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"ADDRESS_STREET",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"ADDRESS_STREET");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"ADDRESS_CITY",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"ADDRESS_CITY");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"ADDRESS_STATE",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"ADDRESS_STATE");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"ADDRESS_POSTCODE",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->textField($model,"ADDRESS_POSTCODE");?>
    </div>
</div>

<div class='control-group'>
    <?php echo $form->label($model,"COUNTRY_ID",array("class"=>"control-label")); ?>
    <div class='controls'>
        <?php echo $form->dropDownList($model,"COUNTRY_ID",CHtml::listData($countries,"COUNTRY_ID","COUNTRY"));?>
    </div>
</div>


<div class="control-group">
    <div class="controls">
        <input type="button" class="btn btn-primary" name="submitSampleDetails" value="Next"/>
    </div>
</div>

<?php

echo $form->hiddenField($model,"PATIENT_ID");
echo $form->hiddenField($model,"MATERIAL_TYPE_ID");
echo $form->hiddenField($model,"SAMPLE_NUMBER");
echo $form->hiddenField($model,"VISIT_ID");

$this->endWidget();

?>

<script type="text/javascript">
    var postSampleFormDetailsUrl="<?php echo Yii::app()->createAbsoluteUrl('/biotracking/biosample/saveSampleDetailsForm')?>";
    $("form#SampleFormDetails").find("input[name='submitSampleDetails']").click(function(event){
        event.preventDefault();
        var serialize= $("form#SampleFormDetails").serialize();
        $.post(postSampleFormDetailsUrl,serialize,function(content){
                alert (content);
        });
    });

</script>