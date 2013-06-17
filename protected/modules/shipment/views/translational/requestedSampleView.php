<?php

$this->breadcrumbs=array(
	$this->module->id,"pending sample availability"
);

?>

<div class="errormsg" style="text-align:center; margin-bottom:50px"> </div>
<div id="divRequestedSample" class="container">
    <div class="row">
        
        <div class="span12">
            <p class="pull-right"><input class="btn btn-primary btn-large" id="reminderAvailability" value="Send reminder"/></p>
        </div>
        
        <div class="span12">
            <?php

            $this->widget("application.components.HtmlTable", array (
                'th'=> array ("SAMPLE ID",'REQUEST DATE',"CENTRE","SCREENING NUMBER","SAMPLE TYPE","SAMPLE NUMBER","REMINDER ALL <input type='checkbox' class='checkAll'/>"),
                'data'=> $activeRecords,
                'td'=> $td,
                'id'=> "requestedSampleTable",
                'extraTD' => array("<input type='checkbox' value='requested' name='REQUESTED[]'/>")
            ));
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">

var requestedSample = {
	init : function(){
            $("#requestedSampleTable").dataTable({
            "bJQueryUI" : true,
            "bPaginate":false,
            // "sPaginationType": "full_numbers",
            'aoColumnDefs': [{"bSortable":false,"aTargets":[6]},
                            {"bVisible": false, "aTargets": [2]}],
            "fnDrawCallback": function ( oSettings ) 
            {
                if ( oSettings.aiDisplay.length == 0 )
                {
                        return true;
                }

                var nTrs = $('#requestedSampleTable tbody tr');
                var iColspan = nTrs[0].getElementsByTagName('td').length;
                var sLastGroup = "";
                for ( var i=0 ; i<nTrs.length ; i++ )
                {
                        var iDisplayIndex = oSettings._iDisplayStart + i;
                        var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[2]; //specifie sur quelle colonne se fait le group by
                        if ( sGroup != sLastGroup )
                        {
                                var nGroup = document.createElement( 'tr' );
                                var nCell = document.createElement( 'td' );
                                nCell.colSpan = iColspan;
                                nCell.className = "group";
                                nCell.innerHTML = "<label>Centre : </label> "+sGroup ;
                                nGroup.appendChild( nCell );
                                nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                                sLastGroup = sGroup;
                        }
                }
            }
      	     
        });
	
        requestedSample.setEventCheckAll();
        requestedSample.setSubmitEvent();
        },
        setEventCheckAll : function(){
		$("#requestedSampleTable").delegate(".checkAll","click", function(){
			var $checked = $(this);
			if ($checked.attr("checked"))
				$("#requestedSampleTable").find("input[name='REQUESTED[]']").prop("checked",true);
			else
				$("#requestedSampleTable").find("input[name='REQUESTED[]']").prop("checked",false);
		});	
	},
        markMaterialToShip: function(){
		$("#requestedSampleTable").find("input:checkbox").each(function(){
			var $checked = $(this);
			var html = $checked.parent().parent();
			if ($checked.attr("checked"))
				$(html).find("input[name='SAMPLE_ID[]']").addClass("checked");
			else
				$(html).find("input[name='SAMPLE_ID[]']").removeClass("checked");
		});
	},
        
        setSubmitEvent : function()
	{
            $("#divRequestedSample").delegate("#reminderAvailability","click",function()
            {
                requestedSample.markMaterialToShip();
                var $serialize = $("#requestedSampleTable").find(".checked").serialize();
                $("#QUERY-PROGRESS").dialog("open");
                var url="<?php echo Yii::app()->createUrl('shipment/translational/requestAvailability');?>";
                $.post(url,$serialize+"&REMINDER=REMINDER",function(request)
                {
                    $("#QUERY-PROGRESS").dialog("close");
                    if(request.status=='success')
                            $("#QUERY-SUCCESS").dialog("open",requestedSample.reloadPage());
                    else
                            $(".errormsg").html(request.errormsg);

                },'json');
            });
	},
        
        reloadPage: function(){
		setTimeout(function (){
			$("#QUERY-SUCCESS").dialog("close");
			$("#requestedSample").trigger("click");
		},1000);
	}
    }

    requestedSample.init();

</script>
