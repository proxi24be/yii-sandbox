<?php $baseUrl=Yii::app()->baseUrl;?>

<div class='tableCompletedFormsOthers'>
    <h2 class="muted"><small>List of biological samples and related available forms</small></h2>    
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="TABLECOMPLETEDFORMSOTHERS">
</div>


<script type="text/javascript" charset="utf-8">
 
var data=<?php echo CJSON::encode($jsonData);?>;

var pdfIcon="<?php echo $baseUrl;?>/images/icons/pdf.png";
 var TableForms = {
      oTable : null,
      init : function ()
      {
            TableForms.renderTable();            
            /*TableForms.setEventRead();*/
      },
      renderTable : function(){
            TableForms.oTable = $("#TABLECOMPLETEDFORMSOTHERS").dataTable({
                "bJQueryUI": true,
                "aaData":data,
                "bSortClasses": false,
                "sPaginationType": "full_numbers",
                "bDeferRender": true,
                "aoColumns":
                 [
                    { "mDataProp": "MATERIAL_ID","sTitle":"SAMPLE ID" },
                    { "mDataProp": "CENTRE_DESCRIPTION","sTitle":"CENTRE NUMBER"},
                    { "mDataProp": "SCREENING_NUMBER","sTitle":"SCREENING NUMBER"},
                    { "mDataProp" :"VISIT_NAME","sTitle":"VISIT"},
                    { "mDataProp" :"MATERIAL_TYPE","sTitle":"SAMPLE TYPE"},
                    { "mDataProp" :"PDF_FORM", "sTitle":"PDF Form" , 
                        "fnRender":function(obj){
                            return "<a href='javascript:TableForms.review(\""+obj.aData['MATERIAL_TYPE']+"\","+obj.aData['MATERIAL_ID']+")'><img width='20' src='"+pdfIcon+"'/></a>";
                        }}
                ],
                "aLengthMenu":[[10],[25],[50]]
            });
      },
      
      review: function (pdf, material_id){
           window.open ("MVC/controllers/pdf/GeneratePDFMaterial.php?material_id="+material_id+"&pdf="+pdf+"&print=no");
      },
      
      fnRender:function(obj)
          {
            var materialID=obj.aData["MATERIAL_ID"];
            return sReturn = "<a href='javascript:TableForms.review(yes,"+materialID+")'><img width='20' src='"+pdfIcon+"'/></a>";
          }
      };
      
      TableForms.init();

</script>
