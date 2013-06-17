<script type="text/javascript">

var tableSampleReturn={
        table: null,
        init : function()
        {
            
            var nCloneTh = document.createElement( 'th' );
            var nCloneTd = document.createElement( 'td' );
            nCloneTd.innerHTML = '<img src="libraryjquery/DataTables-1.8.1/examples/examples_support/details_open.png">';
            nCloneTd.className = "center";
            nCloneTh.innerHTML="Return address";

            $('#tableSampleReturn thead tr').each( function () {
                    this.insertBefore( nCloneTh, this.childNodes[0] );
            } );

            $('#tableSampleReturn tbody tr').each( function () {
                    this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
            } );
                
            tableSampleReturn.table = $("#tableSampleReturn").dataTable({
               
                /*
                 * Insert a 'details' column to the table
                 */
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bPaginate":false,
                "bAutoWidth": false,
                "aoColumnDefs": [
                                { "bSortable": false, "aTargets": [ 0 ] },
                                { "bSearchable": false, "bVisible": false, "aTargets": [ 6 ] }, 
                                { "bSearchable": false, "bVisible": false, "aTargets": [ 7 ] },
                                { "bSearchable": false, "bVisible": false, "aTargets": [ 8 ] },
                                { "bSearchable": false, "bVisible": false, "aTargets": [ 9 ] },
                                { "bSearchable": false, "bVisible": false, "aTargets": [ 10 ] },
                                { "bSortable": false, "aTargets": [ 11 ] }
                    ],
                "iDisplayLength":5,
                "aLengthMenu":[[5]]
            });
            
                /* Add event listener for opening and closing details
                 * Note that the indicator for showing which row is open is not controlled by DataTables,
                 * rather it is done here
                 */
            $('#tableSampleReturn').delegate('tbody td img','click', function () {
                    var nTr = this.parentNode.parentNode;
                    if ( this.src.match('details_close') )
                    {
                            /* This row is already open - close it */
                            this.src = "libraryjquery/DataTables-1.8.1/examples/examples_support/details_open.png";
                            tableSampleReturn.table.fnClose( nTr );
                    }
                    else
                    {
                            /* Open this row */
                            this.src = "libraryjquery/DataTables-1.8.1/examples/examples_support/details_close.png";
                            tableSampleReturn.table.fnOpen( nTr, tableSampleReturn.fnFormatDetails(tableSampleReturn.table, nTr), 'details' );
                    }
            } );
            

            $( ".returnDate" ).datepicker({clickInput: true,
            dateFormat: 'dd-M-yy',
            changeMonth: true,
            //changeYear: true,
            minDate:'-150d',
            maxDate: new Date(),
            showOn: "button",
            buttonImage: "pics/cal.gif",
            buttonImageOnly: true});
            $(".dateAllSamples").datepicker({clickInput: true,
            dateFormat: 'dd-M-yy',
            changeMonth: true,
            //changeYear: true,
            minDate:'-150d',
            maxDate: new Date(),
            showOn: "button",
            buttonImage: "pics/cal.gif",
            buttonImageOnly: true});
            tableSampleReturn.dateAllSamples();
            $("#divTableSampleReturn button").button();
            tableSampleReturn.setSubmitEvent();
        },
        
        fnFormatDetails : function (oTable,nTr)
        {
            var aData = oTable.fnGetData( nTr );
            var temp ;
            //var hrefGeneral = "javascript:window.open('MVC/controllers/ReviewMaterials.php?typeOfReview=general&material_id="+aData[1]+"')";
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px">';
            temp=aData[6]
            if (temp=="")
                temp="/";
            sOut += '<tr><td>Street:</td><td>'+ temp+'</td></tr>';
            temp=aData[7]
            if (temp=="")
                temp="/";
            sOut += '<tr><td>Postcode:</td><td>'+ temp+'</td></tr>';
            temp=aData[8]
            if (temp=="")
                temp="/";
            sOut += '<tr><td>City:</td><td>'+ temp+'</td></tr>';
            temp=aData[9]
            if (temp=="")
                temp="/";
            sOut += '<tr><td>State:</td><td>'+ temp+'</td></tr>';
            temp=aData[10]
            if (temp=="")
                temp="/";
            sOut += '<tr><td>Country:</td><td>'+temp+'</td></tr>';
            sOut += '</table>';
            return sOut;
        },

        reloadPage: function()
        {
            setTimeout(function (){
                $("#AJAX-COMPLETED").dialog("close");
                $("#parcelReceptionDate").trigger("click");
            },500);
        },

        dateAllSamples : function()
        {
            $("#divTableSampleReturn").delegate("button","click",function(){
                var dateForAll=$("#divTableSampleReturn").find(".dateAllSamples").val();
                if (dateForAll!='')
                    $("#tableSampleReturn").find("input[name='RETURN_DATE[]']").each(function()
                    {
                        $(this).val(dateForAll);
                    });
            });
        },

        setSubmitEvent : function()
        {
            $("#returBlockButton").click(function()
            {
                if (tableSampleReturn.checkDate()==0)
                {
                    var data=$("#tableSampleReturn").find("input").serialize();
                    $("#QUERY-PROGRESS").dialog("open");
                    $.post("MVC/controllers/cl/SaveReturnSample.php", data, function(result)
                    {
                        $("#QUERY-PROGRESS").dialog("close");
                        if (result.status=="success")
                            {
                                $("#AJAX-COMPLETED").dialog("open");
                                tableSampleReturn.reloadPage();
                            }
                        else
                            alert ("An unexpected error has occured please contact the BrEAST technical");
                    },"json");
                    
                }
                else
                    ;
            });
        },

        checkDate : function()
        {
            $("#tableSampleReturn").find("input[name='RETURN_DATE[]']").each(function()
                    {
                        if ($(this).val()=='')
                                $(this).addClass("ui-state-error");
                        else
                                $(this).removeClass("ui-state-error");
                    });

            return $("#tableSampleReturn").find(".ui-state-error").length;
        }


}

$(document).ready(function(){
    tableSampleReturn.init();
});

</script>

<style>

#tableSampleReturn td{
	font-size:11px;
	text-align:center;
}


</style>

<div style ="margin-top:100px">
    
<div class="errormsg" style="text-align:center; margin-bottom:50px"> </div>

<p style="width:1100px;padding-bottom:50px"><button class="button ui-corner-all" style="float:right">Confirm Date</button></p>

<form>

<?php

$this->widget("application.components.HtmlTable", array (
    'th'=> array ("MATERIAL_ID", "LOCAL_ID", "CENTRE_DESCRIPTION", "SCREENING_NUMBER", "ADDRESS_STREET", "ADDRESS_POSTCODE", "ADDRESS_STATE", "COUNTRY", "ADDRESS_CITY", "CL_RECEPTION_DATE"),
    'data'=> $oCDbDataReader,
    'td'=> $td,
    'id'=>"tableSampleReturn",
));

?>
</form>

</div>


