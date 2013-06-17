<div id="jqueryTabSample" class="smoothness">

    <?php
        $this->widget('application.views.widget.jquery-ui.Tab', array("tabs"=>$visits,'id'=>"myTabVisits","class"=>"nothingToDo"));
    ?>

</div>

<div class="dataTable">
    
    
</div>

<script type="text/javascript">
        
        var dataUrl="<?php echo Yii::app()->createAbsoluteUrl('/biotracking/main/sampleByVisit');?>";
        var jsonData="";
    
        function initRenderTable (indice,currentVisit){
                /*
                 * Insert a 'details' column to the table
                 */
//                var nCloneTh = document.createElement( 'th' );
//                var nCloneTd = document.createElement( 'td' );
//                nCloneTd.innerHTML = '<img src="libraryjquery/DataTables-1.8.1/examples/examples_support/details_open.png">';
//                nCloneTd.className = "center";
//                nCloneTh.innerHTML="Details"
//
//                $('#myVisit_'+indice+ ' thead tr').each( function () {
//                        this.insertBefore( nCloneTh, this.childNodes[0] );
//                } );
//
//                $('#myVisit_'+indice+ ' tbody tr').each( function () {
//                        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
//                } );
                
                var columnNotVisible=[];
                if (currentVisit=="SCREENING" || "ALL VISITS"==currentVisit || "RECURRENCE"==currentVisit)
                        columnNotVisible=[3,8,9];
                else 
                        columnNotVisible=[1,3,8,9];
                
                /*
                 * Initialse DataTables, with no sorting on the 'details' column
                 */
                var oTable = $('#myVisit_'+indice).dataTable( {

//                  "fnDrawCallback": function ( oSettings ) 
//                  {
//                    if ( oSettings.aiDisplay.length == 0 )
//                    {
//                            return true;
//                    }
//                        var nTrs = $('#myVisit_'+indice+' tbody tr');
//                        var iColspan = nTrs[0].getElementsByTagName('td').length;
//                        var sLastGroup = "";
//                        for ( var i=0 ; i<nTrs.length ; i++ )
//                        {
//                                var iDisplayIndex = oSettings._iDisplayStart + i;
//                                var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[8]; //specifie sur quelle colonne se fait le group by
//                                if ( sGroup != sLastGroup )
//                                {
//                                        var nGroup = document.createElement( 'tr' );
//                                        var nCell = document.createElement( 'td' );
//                                        nCell.colSpan = iColspan;
//                                        nCell.className = "group";
//                                        nCell.innerHTML = sGroup;
//                                        nGroup.appendChild( nCell );
//                                        nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
//                                        sLastGroup = sGroup;
//                                }
//                        }
//                    },


                        // configuration generale des tables
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers",
                        "bDeferRender": true,
                        "aaData":jsonData,
                        "aoColumns": 
                            [
                                { "mDataProp": "MATERIAL_ID","sTitle":"SAMPLE ID" },
                                { "mDataProp": "LOCAL_ID","sTitle":"LOCAL PATHOLOGICAL ID"},
                                { "mDataProp" :"SAMPLE_NUMBER","sTitle":"SAMPLE NUMBER"},
                                { "mDataProp": "PATIENT_ID","sTitle":"PATIENT ID"},
                                { "mDataProp": "SCREENING_NUMBER","sTitle":"SCREENING NUMBER"},
                                { "mDataProp" :"BIRTHDATE","sTitle":"BIRTHDATE"},
                                { "mDataProp" :"COLLECTION_DATE","sTitle":"COLLECTION DATE"},
                                { "mDataProp" :"MATERIAL_TYPE","sTitle":"SAMPLE TYPE"},
                                { "mDataProp" :"VISIT_NAME","sTitle":"VISIT"},
                                { "mDataProp" :"VISIT_INTERVAL","sTitle":"VISIT INTERVAL"},
                                { "mDataProp" :"LOCATION","sTitle":"CURRENT LOCATION"}
                                
                            ],
                         "aoColumnDefs": 
                            [
//                                { "bSortable": false, "aTargets": [ 0 ] },
                                { "bSearchable": false, "bVisible": false, "aTargets": columnNotVisible }, //patient_id 
                            ]
                });

                /* Add event listener for opening and closing details
                 * Note that the indicator for showing which row is open is not controlled by DataTables,
                 * rather it is done here
                 */
//                $('#myVisit_'+indice).delegate('tbody td img','click', function () {
//                        var nTr = this.parentNode.parentNode;
//                        if ( this.src.match('details_close') )
//                        {
//                                /* This row is already open - close it */
//                                this.src = "libraryjquery/DataTables-1.8.1/examples/examples_support/details_open.png";
//                                oTable.fnClose( nTr );
//                        }
//                        else
//                        {
//                                /* Open this row */
//                                this.src = "libraryjquery/DataTables-1.8.1/examples/examples_support/details_close.png";
//                                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
//                        }
//                } );

        }

        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            //var hrefGeneral = "javascript:window.open('MVC/controllers/ReviewMaterials.php?typeOfReview=general&material_id="+aData[1]+"')";
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px">';
            sOut += '<tr><td>See Material Details:</td><td><a href="javascript:review(\'general\',\''+aData[1]+'\')"/>Click here</a></td></tr>';
            sOut += '<tr><td> Current location:</td><td>'+ aData[9]+'</td></tr>';
            sOut += '<tr><td> Current address:</td><td>Not yet available</td></tr>';
            if (aData[7]=='TISSUE') // tissue
                {
                    sOut += '<tr><td> Local Result:</td><td><a href="javascript:review(\'local result\',\''+aData[1]+'\')"/>Click here</a></td></tr>';
                    sOut += '<tr><td> Central lab Result:</td><td><a href="javascript:review(\'central result\',\''+aData[1]+'\')"/>Click here</a></td></tr>';
                }
            sOut += '</table>';
            return sOut;
        }
        
       
        $("div#jqueryTabSample").tabs(
        {
            ajaxOptions: 
            {
                error: function( xhr, status, index, anchor ) {
                        $( anchor.hash ).html(
                                "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                "If this wouldn't be a demo." );
                },
                
                beforeSend:function()
                {
                    $("#PAGE-LOADING").dialog("open");
                },

                success:function(htmlTable)
                {
                    $('div.dataTable').html( htmlTable );
                },
                complete:function()
                {
                    var tabSelected = $("#jqueryTabSample").tabs("option","selected");
                    var currentVisit = $("#jqueryTabSample li.ui-state-active").find("a").text();
                    
                    $.get(dataUrl+"?visitName="+currentVisit,function(data){jsonData=data;},'json')
                    .complete(function(){
                        initRenderTable(tabSelected,currentVisit);
                        $("#PAGE-LOADING").dialog("close");
                    });
                }
            }
	});
        
 </script>