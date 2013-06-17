<?php
    $path = Yii::getPathOfAlias("webroot.javascript.biotracking");
    $assetUrl = Yii::app()->assetManager->publish($path);
    $baseUrl=Yii::app()->baseUrl;
?>

<style>
    
    div.defaultHidden , .defaultHidden
    {
        display:none;
    }
    
    form label
    {
        font-weight: bold;
    }
    
</style>

<div id="selectMaterial">
    
        <form class="form-horizontal" id="materialForm" action="<?php echo Yii::app()->createAbsoluteUrl('/biotracking/biosample/getSampleDetails');?>" method="post">
            <fieldset>
              <legend>NEW SAMPLE REGISTRATION</legend>
              <p>Sample basic information</p>
              <div class="control-group patient">
                  <label class="control-label">Patient number</label>
                  <div class="controls">
                      <select name ="PATIENT_ID">
                          <option value="0"></option></select> 
                  </div>
              </div>
              
              <div class="control-group birthdate defaultHidden">
                  <label class="control-label">Patient birthdate</label>
                  <div class="controls">
                      <input name ="birthdate_dd_mmm_yyyy" type="text" id="BIRTHDATE_DD_MMM_YYYY" size="13" value="" readonly="readonly"/>
                      <span  class="help-block" style="width:450px;"><small><i>(For data protection reasons the date of birth will not appear on any report,
                        nevertheless,it is strongly encouraged to report it for quality control reasons)</i></small></span>
                      <input type="hidden" id="BIRTHDATE_DD_MM_YYYY" name="birthdate_dd_mm_yyyy" size="30" value=""/>
                  </div>
              </div>
              
              <div class="control-group visit defaultHidden">
                  <label class="control-label">Visit</label>
                  <div class="controls">
                      <select  name ="VISIT_ID"><option value="0"></option></select>
                  </div>
              </div>
              
              <div class="control-group sampleKit defaultHidden">
                  <label class="control-label">Sample Kit number</label>
                  <div class="controls">
                      <input type="text" id="KIT_NUMBER_ID" name ="KIT_NUMBER_ID" value=""/>
                  </div>
              </div>
              
              <div class="control-group sampleType defaultHidden">
                  <label class="control-label">Sample type</label>
                  <div class="controls">
                      <select name ="MATERIAL_TYPE_ID" onchange="typeOfMaterial()"><option value="0"></option></select>
                      <span class="infoProtocolTissue defaultHidden help-block" style="width:450px;">
                          <small><i>Dear User, we remind you that only tumour blocks from primary surgery should be sent to the central lab for screening. Samples from core biopsies are not acceptable</i> (<b>protocol section 5.6.1.1</b>)</small>
                      </span>
                  </div>
                  <div class="tissueScreening defaultHidden">
                      <p>
                          <div> <!--ce div additionel garantie que l'effet bounce sous jquery ne modifie pas la position de l'élément-->
                            <label class="control-label">Conditioning</label>
                            <div class="controls">
                                <select name="CONDITIONING">
                                    <option value="0"></option>
                                    <option value="PARAFFIN EMBEDDED">PARAFFIN EMBEDDED</option>
                                    <option value="FROZEN">FROZEN</option>
                                </select>
                            </div>
                          </div>
                      </p>
                      <p>
                        <div>
                            <label class="control-label ">Laterality</label>
                            <div class="controls">
                                <select name="LATERALITY">
                                    <option value="0"></option>
                                    <option value="LEFT">LEFT</option>
                                    <option value="RIGHT">RIGHT</option>
                                </select>
                            </div>
                        </div>
                      </p>
                  </div> <!--tissue-->
                  
                  <div class="blood defaultHidden">
                      <p>
                          <div>
                          <label class="control-label">Use for</label>
                            <div class="controls">
                                <select name="blood_technical">
                                    <option value="0"></option>
                                    <option value="999">CLINICAL GENOTYPING</option>
                                    <option value="801">CIRCULATING BIOMARKERS</option>
                                </select>
                            </div>
                          </div>
                      </p>
                  </div> <!--blood-->
              </div> <!--sampleType-->
              
              <div class="control-group endTaxanes defaultHidden">
                  <p class="liEndTaxanes ui-state-highlight ui-corner-all" style ="font-size:12px;display:none">
                      <span class="ui-icon ui-icon-info" style="float: left"></span><b>As this sample could be collected at the beginning of cycle 4 (week 10) or cycle 5 (week 13) if an Anthracycline was given previously or at cycle 7 (week 19) if Taxane was given alone, 
                          please choose carefully from the drop-down list the applicable cycle/week when this sample was collected.</b></p>
                  <label class="control-label">Applicable cycle/week</label>
                  <div class="controls">
                      <select name="endTaxanes">
                          <option value="0"></option><option value="953">TARGETED TREATMENT CYCLE 4 (week 10)</option>
                          <option value="954">TARGETED TREATMENT CYCLE 5 (week 13)</option>
                          <option value="955">TARGETED TREATMENT CYCLE 7 (week 19)</option>
                      </select>
                  </div>
              </div>
              
              <div class="control-group sampleNumber defaultHidden">
                  <label class="control-label">Sample number</label>
                  <div class="controls">
                      <input id="SAMPLE_NUMBER" name ="SAMPLE_NUMBER" value="" class="input-mini ui-state-hover ui-corner-all" readonly="readonly"/>
                  </div>
              </div>

            <ul class="ul.materialExist defaultHidden">

                <p class="ui-state-highlight ui-corner-all"><span class="ui-icon ui-icon-info" style="float: left"></span><b>The same sample type was already registered for this patient. </br>Would you like to continue ? </b></p>
                <p> <input type="radio" name="newExistingSample" value="newSample" /> <span>Yes, I would like to register a new sample</span></p>
                <p> <input type="radio"  name="newExistingSample" value="registeredSample" /> <span>No, please show me the list of registered samples</span></p>

            </ul>
              
              <div class="control-group">
                  <div class="controls">
                      <input type="submit" id="buttonSelectedMaterial" class="btn btn-primary" value="Next">
                  </div>
              </div>
    
            </fieldset>
        </form>
</div>


<div id="birthdate-confirm" title="Confirm patient birthdate">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
          </span>You have entered the following patient birthdate: <span id="SPANCONFIRMBIRTHDATE" style ="font-weight: bold"></span> <p>Do you want to continue ? (This action cannot be undone)</p></p>
</div>

<div id="german-birthdate-confirm" title="Confirm patient birthdate">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            <b>Warning:</b> due to the German regulation on data protection, <b>only the year of birth</b> can be reported.</p>
        <p>Therefore, please report 30-June (data entry convention) for the day and month.</p> 
        <p>Thank you.</p>
</div>


<div id="sampleKitNumberConfirm" title="Confirm sample kit ID">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            <b>Warning:</b> The kit number that you have entered is not as the kit number assigned at randomisation.</p>
            <p>Do you still want to confirm ?</p>
</div>

<script type="text/javascript" src="<?php echo $assetUrl;?>/date.js"></script>
<script type="text/javascript" src="<?php echo $assetUrl;?>/KitNumber.js"></script>
<script type="text/javascript" src="<?php echo $assetUrl;?>/Patient.js"></script>
<script type="text/javascript" src="<?php echo $assetUrl;?>/SampleNumber.js"></script>

<script type="text/javascript">

// le json est injecté directement via php
    KitNumber.setData(<?php echo CJSON::encode($kitNumber);?>);
    Patient.setData(<?php echo CJSON::encode($patient);?>);
    SampleNumber.setData(<?php echo CJSON::encode($sampleNumber);?>);

    function setKitNumberOfPatient()
    {
        var patientID= $("form#materialForm").find("select[name='PATIENT_ID']").val();
        KitNumber.findKitNumber("PATIENT_ID",patientID);
        $("#KIT_NUMBER_ID").val(KitNumber.kitNumberInserted);
    }

    function displayKitIfRandomised()
    {
        var patientID= $("form#materialForm").find("select[name='PATIENT_ID']").val();
        var visitID=$("form#materialForm").find("select[name='VISIT_ID']").val();

        if (KitNumber.isPatientRandomised(patientID) && visitID !== '442')
            $("div.sampleKit").css({"display":"block"});
        else
            $("div.sampleKit").css({"display":"none"});
    }

    var conditioning=
    {
        SCREENING:{id:'PARAFFIN EMBEDDED',text:'PARAFFIN EMBEDDED'},
        RANDOMISATION:{id:'FROZEN',text:"FROZEN"}
    }

var SelectMaterial = {
    selectedValues : [],
    checkingOk:false,
    kitNumberOk:false,
    goToNextStep : false,
    checkingMaterialInfo: [],
    materialAlreadyExist:false,
    userChoice : "newSample",

    init : function (){

        $( "#dialog:ui-dialog" ).dialog( "destroy" );

        $( "#german-birthdate-confirm" ).dialog({
            resizable: false,
            height:250,
            width:350,
            modal: true,
            autoOpen:false
        });

        SelectMaterial.setPatientEvent();
        SelectMaterial.setVisitEvent();
        SelectMaterial.setDatePicker();
        SelectMaterial.setButton();
        SelectMaterial.setScreeningNumber();
        SelectMaterial.setSelectEvent();
        SelectMaterial.setRadioEvent();
    },

    setScreeningNumber: function (){
        Patient.setScreeningNumber();
    },

    setPatientEvent:function()
    {
        $("form#materialForm").find("select[name='PATIENT_ID']").change(function(){
            var patientID=$("form#materialForm").find("select[name='PATIENT_ID']").val();
            var urlVisit="<?php echo Yii::app()->createAbsoluteUrl('/biotracking/patient/getVisit');?>";
            Patient.setVisit(patientID,urlVisit,"form#materialForm select[name='VISIT_ID']");
            setKitNumberOfPatient();
            Patient.setBirthDate();
            $("div.visit").fadeIn(1500);
        });
    },

    setVisitEvent:function()
    {
        $("form#materialForm").find("select[name='VISIT_ID']").change(function(){
            var patientID=$("form#materialForm").find("select[name='PATIENT_ID']").val();
            var visitID=$("form#materialForm").find("select[name='VISIT_ID']").val();
            var url="<?php echo Yii::app()->createAbsoluteUrl('/biotracking/patient/getSampleType')?>";
            Patient.setSampleType(patientID, visitID, url, "form#materialForm select[name='MATERIAL_TYPE_ID']");
            displayKitIfRandomised();
            $("div.sampleType").fadeIn(1500);
        });
    },

    setDatePicker : function(){
        $( "#BIRTHDATE_DD_MMM_YYYY" ).datepicker({
            showOn: "button",
            buttonImage: "<?php echo $baseUrl;?>/images/icons/cal.gif",
            buttonImageOnly: true,
            dateFormat:"dd/M/yy",
            altField: "#BIRTHDATE_DD_MM_YYYY",
            altFormat:"dd/mm/yy",
            changeMonth: true,
            changeYear:true,
            yearRange:"-90:+0"
        });
    },

    setButton :function (){

    },

    saveCurrentValues: function (){
        var $elem = $("#HIDDENDIV");
        $.data ($elem,"selectedinfo" ,{patient_id:$("#LIPATIENT").find("select option:selected").val(),
            material_type_id:$("#LIMATERIAL").find("select option:selected").val()});
    },

    setSelectEvent : function(){
        var $select = $("#materialForm");
        $select.delegate ("select","change",function(){
            var name = $(this).attr("name");
            var $option = $(this).find("option:selected");
            SelectMaterial.selectedValues[name]= {id: $option.val(), text: $option.text()};

            var index = $option.index();
            if (index!=0)
                $(this).prev().removeClass("ui-state-error-text");

            if (name=="MATERIAL_TYPE_ID")
            {
                SelectMaterial.getSampleNumber();
                if ($option.text()=="SERUM" || $option.text()=="PLASMA")
                    SelectMaterial.checkIfMaterialAlreadyExist();
            }

            if (name=="CONDITIONING")
            {
                if ($option.text()=='PARAFFIN EMBEDDED')
                {
                    //reccurence
                    if ($("div.visit").find("select option:selected").val()==445)
                    {
                        $("#SAMPLE_NUMBER").val("102");
                        SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:102,text:102};
                    }
                    else
                    {
                        $("#SAMPLE_NUMBER").val("101");
                        SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:101,text:101};
                    }

                }
                else if ($option.text()=='FROZEN')
                {
                    $("#SAMPLE_NUMBER").val("151");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:151,text:151};
                }
                else ;
            }

            if (name=="blood_technical")
            {
                if ($option.text()=='CLINICAL GENOTYPING')
                {
                    $("#SAMPLE_NUMBER").val("999");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:999,text:999};
                }
                else if ($option.text()=='CIRCULATING BIOMARKERS')
                {
                    $("#SAMPLE_NUMBER").val("801");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:801,text:801};
                }
                else ;

                SelectMaterial.checkIfMaterialAlreadyExist();
            }

            if (name=="endTaxanes")
            {
                if ($option.text()=='TARGETED TREATMENT CYCLE 4 (week 10)')
                {
                    $("#SAMPLE_NUMBER").val("953");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:953,text:953};
                }
                else if ($option.text()=='TARGETED TREATMENT CYCLE 5 (week 13)')
                {
                    $("#SAMPLE_NUMBER").val("954");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:954,text:954};
                }
                else if ($option.text()=='TARGETED TREATMENT CYCLE 7 (week 19)')
                {
                    $("#SAMPLE_NUMBER").val("955");
                    SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:955,text:955};
                }

                else ;

                SelectMaterial.checkIfMaterialAlreadyExist();
            }

            if (name=="LATERALITY")
                SelectMaterial.checkIfMaterialAlreadyExist();

        });
    },

    getSampleNumber : function(){
        var selectedVisit= $("#LIVISIT").find("select").val();
        if (SelectMaterial.selectedValues["MATERIAL_TYPE_ID"].id !=54 && SelectMaterial.selectedValues["MATERIAL_TYPE_ID"].id !=23 && selectedVisit!=447)
        {
            var data = SampleNumber.getSampleNumber(SelectMaterial.selectedValues['VISIT_ID'].id, SelectMaterial.selectedValues['MATERIAL_TYPE_ID'].id);
            $("#SAMPLE_NUMBER").val(data);
            SelectMaterial.selectedValues["SAMPLE_NUMBER"]={id:data,text:data};
        }
    },

    checkSelection: function(){
        SelectMaterial.higlightUnSelected();
        var $error = $(".ui-state-error-text").filter(":visible");

        if ($error.size()==0)
            SelectMaterial.checkingOk=true;
        else
            SelectMaterial.checkingOk=false;
    },

    higlightUnSelected:function(){

        var selectVisible = $("form#materialForm").find("select:visible");
        selectVisible.each(function(){
            if ($(this).val()==0)
                $(this).parent().prev().addClass("ui-state-error-text")
                        .effect("bounce",{ times:3 }, 300);
            else
                $(this).parent().prev().removeClass("ui-state-error-text");
        });

        if ($("#KIT_NUMBER_ID").val()=='')
            $("#LIKITNUMBER").find("label").addClass("ui-state-error-text").effect("bounce",{times:3},300);
        else
            $("#LIKITNUMBER").find("label").removeClass("ui-state-error-text");
    },

    checkIfMaterialAlreadyExist: function (){
        var $materialTypeID = SelectMaterial.selectedValues["MATERIAL_TYPE_ID"].id;
        var $patientID= SelectMaterial.selectedValues["PATIENT_ID"].id;
        var $visitID= SelectMaterial.selectedValues["VISIT_ID"].id;
        var $data="PATIENT_ID="+$patientID+"&MATERIAL_TYPE_ID="
                +$materialTypeID+"&VISIT_ID="+$visitID;

        if (SelectMaterial.selectedValues["MATERIAL_TYPE_ID"].id == '54')
        {
            var $conditioning=SelectMaterial.selectedValues["CONDITIONING"].id;
            var $laterality = SelectMaterial.selectedValues["LATERALITY"].id;
            $data +="&CONDITIONING="+$conditioning+"&LATERALITY="+$laterality;
        }
        else
        {
            var $sampleNumber= $("#SAMPLE_NUMBER").val();
            $data +="&SAMPLE_NUMBER="+$sampleNumber;
        }
    },

    setRadioEvent: function()
    {
        $(".ULul.materialExist").delegate("input","change",function(){
            if ($(this).filter(":checked").val()=='newSample')
                SelectMaterial.userChoice='newSample';
            else if ($(this).filter(":checked").val()=='registeredSample')
                SelectMaterial.userChoice='registeredSample';
            else;

        });
    }

};

$("#buttonSelectedMaterial").click(function(event){
    event.preventDefault();
    SelectMaterial.checkSelection();
    if (SelectMaterial.checkingOk)
    {
        $("#PAGE-LOADING").dialog("open");
        $("form#materialForm").submit();
    }
});
    
    function getMaterialForm ()
    {
        if (SelectMaterial.checkingOk)
        {
            $("div.birthDate").find("input").each(function(){
                SelectMaterial.selectedValues[$(this).attr("name")]={id:$(this).val(),text:$(this).val()};
            });

            if ((!Patient.birthdateAlreadyExist) && ($("#BIRTHDATE_DD_MMM_YYYY").val()!=''))
            {
                if ($("#COUNTRYSITE").val()=='GERMANY')
                {
                   var $date = $("#BIRTHDATE_DD_MM_YYYY").val();
                   var pattern=/^30\/06\// ;
                   if (!pattern.test($date))
                       {
                           $("#german-birthdate-confirm").dialog("open");
                           Patient.birthdateAlreadyExist=false;
                       }
                }

                else
                {
                    $("#SPANCONFIRMBIRTHDATE").text($("#BIRTHDATE_DD_MMM_YYYY").val());
                    $("#birthdate-confirm").dialog("open");
                }
            }

            if ($("#KIT_NUMBER_ID").is(":visible")==false)
                  SelectMaterial.kitNumberOk=true;

            if (SelectMaterial.kitNumberOk == false)
            {
                var patientID= $("div.patient").find("select").val();
                var kitNumberToInsert=$("#KIT_NUMBER_ID").val();
                KitNumber.checkKitNumber(SelectMaterial,kitNumberToInsert, patientID);
            }
        }
            
    };

    function typeOfMaterial (){
        var currentSelected =  $("form#materialForm").find("select[name='MATERIAL_TYPE_ID']").val();
        var selectedVisit= $("form#materialForm").find("select[name='VISIT_ID']").val();
        if (currentSelected != 0)
        {
            if (currentSelected==54) //tissue
            {
                $("div.tissueScreening").fadeIn(1500);//
                $("div.tissueScreening select").find("option:eq(0)").attr("selected","selected");
                $("div.sampleNumber").fadeIn(1500);
                $("div.sample select").find("option:eq(0)").attr("selected","selected");
                $("div.blood").fadeOut("slow");
            }
            else if (currentSelected==23)  // blood
            {
                $("div.tissueScreening").fadeOut("slow");
                $("div.blood").fadeIn(1500);
                $("div.sampleNumber").fadeIn(1500);
                $("div.blood select").find("option:eq(0)").attr("selected","selected");
            }

            else if ((currentSelected==49) && (selectedVisit==447)) // serum
            {
                $("div.tissueScreening").fadeOut("slow");
                $("div.blood").fadeOut("slow");
                $("div.endTaxanes").fadeIn(1500);
                $("div.endTaxanes select").find("option:eq(0)").attr("selected","selected");
                $("div.sampleNumber").fadeIn(1500);
            }
            else
            {
                $("div.tissueScreening").fadeOut("slow");
                $("div.blood").fadeOut("slow");
                $("div.endTaxanes").fadeOut("slow");
                $("div.sampleNumber").fadeIn(1500);
            }

        }
        else
        {
            $("div.blood").fadeOut("slow");
            $("div.endTaxanes").fadeOut("slow");
        }
    }

    $(document).ready(function()
    {
        SelectMaterial.init();
        KitNumber.init();    
    });
   
</script>