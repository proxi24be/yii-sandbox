<?php $baseUrl=Yii::app()->baseUrl;?>

<div class="dataTable">
    <h2 class="muted"><small>List of biological samples and related available forms</small></h2>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="tableCompletedFormTissue">

    </table>
</div>
    
<script type="text/javascript">
    var data=<?php echo CJSON::encode($jsonData);?>;
    
    var pdfIcon="<?php echo $baseUrl;?>/images/icons/pdf.png";
    var htmlTable=
    {
        table:null,
        init:function()
        {
             htmlTable.table=$('#tableCompletedFormTissue').dataTable({
                "bJQueryUI": true,
                "aaData":data,
                "bSortClasses": false,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "aoColumns": 
                 [
                    { "mDataProp": "MATERIAL_ID","sTitle":"SAMPLE ID" },
                    { "mDataProp": "CENTRE_DESCRIPTION","sTitle":"CENTRE NUMBER"},
                    { "mDataProp": "SCREENING_NUMBER","sTitle":"SCREENING NUMBER"},
                    { "mDataProp" :"BIRTHDATE","sTitle":"BIRTHDATE"},
                    { "mDataProp" :"MATERIAL_TYPE","sTitle":"SAMPLE TYPE"},
                    { "mDataProp" :"DATE_PICKUP","sTitle":"DATE PICKUP"},
                    { "mDataProp" :"CL_RECEPTION_DATE", "sTitle":"CL RECEPTION DATE"},
                    { "mDataProp" :"HER2_ELIGIBLE", "sTitle":"HER2 ELIGIBLE" , 
                        "fnRender":function(obj){
                            return "<b>"+obj.aData["HER2_ELIGIBLE"]+"</b>";
                        }},
                    { "mDataProp" :"SAMPLE_EVALUABLE", "sTitle":"SAMPLE EVAlUABLE"},
                    { "mDataProp" :"LOCAL_RESULT", "sTitle":"LOCAL RESULT",
                        "fnRender": function(obj) {
                            return htmlTable.fnRender("local result", obj,"LOCAL_RESULT");
                    }},
                    { "mDataProp" :"PART1_MATERIAL_ID", "sTitle":"CENTRAL RESULT PART1",
                        "fnRender": function(obj) {
                            return htmlTable.fnRender("central result", obj,"PART1_MATERIAL_ID");
                    }},
                    { "mDataProp" :"PART2_MATERIAL_ID","sTitle":"CENTRAL RESULT PART2",
                        "fnRender": function(obj) {
                            return htmlTable.fnRender("central result 2", obj,"PART2_MATERIAL_ID");
                    }}
                ],
                "aoColumnDefs": [
                         { "bSortable": false, "bVisible":false, "aTargets": [3,4,8] },
                         { "bSortable": false, "aTargets": [9,10,11] }
                    ]
             });
             
        },
        
        valueIsNumeric: function(value)
        {
          if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
              return true;
          } else {
              return false;
          } 
        },
        review: function (typeOfReview, material_id){
          window.open ("ReviewMaterials.php?typeOfReview="+typeOfReview+"&material_id="+material_id+"&jobUser=readOnly","reviewPopup","status=no,toolbar=no, menubar=no, width=1000, height=800, scrollbars=yes,resize=0");
      },
        fnRender:function(typeOfForm,obj,param)
          {
              var sReturn=obj.aData[param];
                if ( htmlTable.valueIsNumeric(obj.aData[param]) ) {
                    sReturn = "<a href='javascript:htmlTable.review(\""+typeOfForm+"\","+obj.aData[param]+")'><img width='20' src='"+pdfIcon+"'/></a>";
                }
                return sReturn;
          }
    }
    
    htmlTable.init();
    
</script>