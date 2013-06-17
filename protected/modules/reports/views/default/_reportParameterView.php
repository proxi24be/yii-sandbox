<div class="span1 wizardStep muted">2</div>

<?php
    echo "<div class='span5 control-group'>";
    echo CHtml::activeLabel($model, "FORMAT", array("class"=>"control-label"));
    echo CHtml::activeDropDownList($model, "FORMAT", $formats);
    echo "</div>";
?>

<div class="clearfix"></div>

<div class="wizardStep span1 muted">3</div>
<div class="span10">
    <p style="margin-left:25px">Please select the data that you want to appear in your report (<b>only highlighted items will be reported</b>) :</p>
    <p style="margin-left:25px" class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
    <span style="margin-left:20px; display:block">You can select multiple data by holding <b>shift</b> or <b>ctrl</b> key.</span> </p>
</div>

<div class="report">
    <?php 
        $listBoxReport = new ListBoxReport($model,$params);
        $listBoxReport->displayAllListBox();
    ?>
</div>

<hr/>

<div class="clearfix"></div>

<div class="form-actions actionUserGroup">
        <a href="<?php echo Yii::app()->createUrl('reports/'); ?>" class="cancelButton">Cancel</a>
        <?php echo CHtml::submitButton('Order',array("class"=>"submitButton btn btn-primary")); ?>
</div>

<script type="text/javascript">
    
var listBox=
{
    idList:new Array(),
    //definit quel listbox sera mise à jour suivant la selection de l'utilisateur
    listBoxEventOrder:{GROUP_ID:new Array('#ReportForm_COUNTRY_ID'),REGION_ID:new Array('#ReportForm_RANDO_SITE_ID','#ReportForm_CURRENT_SITE_ID'),
        RANDO_SITE_ID:{PATIENT_POSITION_ID:new Array('#ReportForm_PATIENT_POSITION_ID'),SCREENING_PATIENT_ID:new Array('#ReportForm_SCREENING_PATIENT_ID')},
        CURRENT_SITE_ID:{PATIENT_POSITION_ID:new Array('#ReportForm_PATIENT_POSITION_ID'),SCREENING_PATIENT_ID:new Array('#ReportForm_SCREENING_PATIENT_ID')}},
    option:{GROUP_ID:new Array("REGION_ID","COUNTRY"),REGION_ID:new Array("RANDO_SITE_ID","RANDO_CRTN"),
        RANDO_SITE_ID: { PATIENT_POSITION_ID :new Array("PATIENT_POSITION_ID","PATIENT"), SCREENING_PATIENT_ID: new Array("SCREENING_PATIENT_ID","PATIENT")},
        CURRENT_SITE_ID: {PATIENT_POSITION_ID:new Array("PATIENT_POSITION_ID","PATIENT"), SCREENING_PATIENT_ID: new Array("SCREENING_PATIENT_ID","PATIENT")}},
    setContent :function (id,objData)
    {
        // nettoyage du contenu précedent 
        $(id).html("");
        if (id != '#ReportForm_COUNTRY_ID')
        {
            var myOption= "<option value='ALL'>ALL</option>";
            $(id).append(myOption); 
        }
        for (var idOption in objData)
        {
//                merci IE !!!
            var myOption= "<option value='"+idOption+"'>"+objData[idOption]+"</option>";
            $(id).append(myOption); 
        }
    },
    
    init:function()
    {
        listBox.parseListBoxID();
        listBox.setListBoxEvent();
    },
    
    setListBoxEvent :function()
    {
        var taille = listBox.idList.length;
        var lastListBox = listBox.idList[taille-1].column;
        for (var i=0; i < listBox.idList.length; i++)
        {
            if (listBox.idList[i].column != 'PATIENT_POSITION_ID' && listBox.idList[i].column !='SCREENING_PATIENT_ID')
            {
                var param=new Object();
                var objectFieldToCompare=new Object();
                param.listBoxID= listBox.idList[i].id;
                if ((listBox.idList[i].column =='RANDO_SITE_ID' || listBox.idList[i].column=='CURRENT_SITE_ID')
                    && (lastListBox=='PATIENT_POSITION_ID' || lastListBox=='SCREENING_PATIENT_ID' ))
                {
                    param.optionID=listBox.option[listBox.idList[i].column][lastListBox][0];
                    param.optionText=listBox.option[listBox.idList[i].column][lastListBox][1];
                    param.newListBoxContentID=listBox.listBoxEventOrder[listBox.idList[i].column][lastListBox];
                }
                else
                {
                    param.optionID=listBox.option[listBox.idList[i].column][0];
                    param.optionText=listBox.option[listBox.idList[i].column][1];
                    param.newListBoxContentID=listBox.listBoxEventOrder[listBox.idList[i].column];
                }
                
    //            creation artificielle de l'objet avec l'attribut qui permettra de faire la comparaison
                objectFieldToCompare[listBox.idList[i].column]='dummy';
                
                listBox.setAllListBoxEvent(param, objectFieldToCompare);
            }
        }
    },
    
    parseListBoxID:function()
    {
        var split="ReportForm_";
        var cpt=0;
        $("div.report").find("select.report").each(function()
        {
            var id = $(this).attr("id");
            listBox.idList[cpt++]={id:id,column:id.substring(split.length,id.length)};
        });
    },
    
    setAllListBoxEvent:function(param,objectFieldToCompare)
    {
        $('#'+param.listBoxID).click(function()
        {
            //        il y en a qu'un 
            for (var fieldToCompare in objectFieldToCompare);
            if (fieldToCompare=='GROUP_ID')
                var filters={GROUP_ID:$(this).val()};
            else if (fieldToCompare=='REGION_ID')
                var filters={REGION_ID:$(this).val()};
            else if (fieldToCompare=='RANDO_SITE_ID')
                var filters={RANDO_SITE_ID:$(this).val()};
            else if (fieldToCompare=='CURRENT_SITE_ID')
                var filters={CURRENT_SITE_ID:$(this).val()};
            else;
            
            var options={id:param.optionID,text:param.optionText};
            var objData =reportParam.getOptionData(filters,options,param.optionText);
            for (var i=0; i <param.newListBoxContentID.length ;i++)
            {
                listBox.setContent(param.newListBoxContentID[i],objData);
                $(param.newListBoxContentID[i]).find("option:first").attr('selected','selected');
            }
        })
    }
}

$(document).ready(function()
{
   listBox.init();
//   submitReport.init();
});

</script>