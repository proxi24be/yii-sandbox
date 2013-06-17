<?php 
    $baseUrl= Yii::app()->baseUrl;
?>

<link type="text/css" href="<?php echo $baseUrl;?>/css/jquery-ui/smoothness/smoothness.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl;?>/css/datatable/demo_table_jui.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl;?>/css/datatable/demo_page.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl;?>/css/datatable/demo_table.css" rel="Stylesheet" />
<script type="text/javascript" src="<?php echo $baseUrl; ?>/javascript/DataTables-1.8.1/jquery.dataTables.min.js"></script>

<style>
    
    table#example,table#example th, table#example td, table#example div.dataTables_paginate
    {
        font-size: 90%;
    }
    
</style>

<script type="text/javascript">
    
    var data=null;
    var htmlTable=
    {
        table:null,
        init:function()
        {
             $('#example').dataTable({
                "bJQueryUI": true,
                "aaData":data,
                "bSortClasses": false,
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
                    { "mDataProp" :"HER2_ELIGIBLE", "sTitle":"HER2 ELIGIBLE"},
                    { "mDataProp" :"SAMPLE_EVALUABLE", "sTitle":"SAMPLE EVAlUABLE"},
                    { "mDataProp" :"LOCAL_RESULT", "sTitle":"LOCAL RESULT",
                        "fnRender": function(obj) {
                            var sReturn = obj.aData[ obj.iDataColumn ];
                            if ( htmlTable.valueIsNumeric(sReturn) ) {
                                sReturn = "<b>PDF</b>";
                            }
                            return sReturn;
                    }},
                    { "mDataProp" :"PART1_MATERIAL_ID", "sTitle":"CENTRAL RESULT PART1"},
                    { "mDataProp" :"PART2_MATERIAL_ID","sTitle":"CENTRAL RESULT PART2" }
                ],
                "aoColumnDefs": [
                         { "bSortable": false, "bVisible":false, "aTargets": [3,4,8] },
                         { "bSortable": false, "aTargets": [9,10,11] }
                    ]
             });
             
             $("div.fin").html('fin:'+new Date());
             
             data=null;
        },
        
        valueIsNumeric: function(value)
        {
            try 
            {
                parseInt(value);
                return true;
            }
            catch (exception)
            {
                return false;
            }
        }
    }
    
    $(document).ready(function(){
        var url='<?php echo Yii::app()->createUrl("biotracking/centrallab/CompletedFormTissue");?>';
         $('#demo').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"></table>' );
        $.get(url,function(jsonData){
                data=jsonData;
        },'json').complete(function(){
            htmlTable.init();
        });
    });
    
    
</script>


<div id="demo" class="smoothness">
    
    
</div>


<div class="debut">
    <script type="text/javascript">
        var d=new Date();
        document.write('debut:'+d);
    </script>
</div>

<div class="fin">
    
</div>