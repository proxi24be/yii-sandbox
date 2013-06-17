<style>
    
    span#listOfReceivers label
    {
        display:inline;
        font-weight: bold;
    }
    
</style>

<?php

$this->breadcrumbs=array(
    $this->module->id,"Sample confirmed for shipment"
);

?>

<div id="divRequestShipment" class="container">
    <div class="row">
        
        <div class="span4 alert">
            <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
            <span style="margin-left:20px; display:block">List of users who will receive the notification email</span></p>
            <?php echo CHtml::checkboxList ("listOfReceivers",$receiverCheckByDefault, $listOfReceivers);?>
        </div>
            
        <div class="span12">
            <p class=" pull-right">
                <input class="button btn btn-primary btn-large" id="requestShipment" value="Send shipment request"/>
            </p>
        </div>
        <div class="span12">
        <?php

        $this->widget("application.components.HtmlTable", array (
            'th'=> array ("SAMPLE ID",'AVAILABILITY REQUEST DATE',"CENTRE","CONFIRMATION DATE","SCREENING NUMBER","SAMPLE TYPE",
            "SAMPLE NUMBER"," CHECK ALL <input type='checkbox' class='checkAll'/>"),
            'data'=> $activeRecords,
            'td'=> $td,
            'id'=> "requestShipmentView",
            'extraTD' => array("<input type='checkbox' value='requested' name='REQUESTED[]'/>")
        ));

        ?>
        </div>
    </div>
</div>

<script type="text/javascript">

var requestShipment = {
	init : function(){
		$("#requestShipmentView").dataTable({
			"bJQueryUI" : true,
            "bPaginate":false,
            'aoColumnDefs': [{"bSortable":false,"aTargets":[7]},
                            {"bVisible": false, "aTargets": [2]}],
		"fnDrawCallback": function ( oSettings ) 
		{
            if ( oSettings.aiDisplay.length == 0 )
            {
                    return true;
            }

            var nTrs = $('#requestShipmentView tbody tr');
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
                        nCell.innerHTML = "<label>CENTRE : </label>"+sGroup ;
                        nGroup.appendChild( nCell );
                        nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                        sLastGroup = sGroup;
                }
            }
        }
      	  
		});
		
		requestShipment.setEventCheckAll();
		$("button").button();
		requestShipment.setSubmitEvent();

	},
	markMaterialToShip: function(){
		$("#requestShipmentView").find("input:checkbox").each(function(){
			var $checked = $(this);
			var html = $checked.parent().parent();
			if ($checked.attr("checked"))
				$(html).find("input[name='SAMPLE_ID[]']").addClass("checked");
			else
				$(html).find("input[name='SAMPLE_ID[]']").removeClass("checked");
		});
	},

	setEventCheckAll : function(){
		$("#requestShipmentView").delegate(".checkAll","click", function(){
			var $checked = $(this);
			if ($checked.attr("checked"))
				$("#requestShipmentView").find("input[name='REQUESTED[]']").prop("checked",true);
			else
				$("#requestShipmentView").find("input[name='REQUESTED[]']").prop("checked",false);
		});	
	},

	setSubmitEvent : function()
	{
            $("input#requestShipment").click(function(){
                    requestShipment.markMaterialToShip();
                    var listOfReceivers = $("#listOfReceivers").find("input[name='listOfReceivers[]']").serialize();
                    var $serialize = $("#requestShipmentView").find(".checked").serialize();
                    $("#QUERY-PROGRESS").dialog("open");
                    var url = "<?php echo Yii::app()->createUrl('shipment/translational/sendShipmentRequest');?>";
                    $.post(url,$serialize+"&"+listOfReceivers,function(){
                                    $("#QUERY-PROGRESS").dialog("close");
                    }).complete(function(){
//                                    $("#QUERY-SUCCESS").dialog("open",requestShipment.reloadPage());
                    });
            });
	},

	reloadPage: function(){
            setTimeout(function (){
                    $("#QUERY-SUCCESS").dialog("close");
                    window.location.href="<?php echo Yii::app()->createAbsoluteUrl('/shipment/translational/requestShipment');?>";
            },1000);
	}
}

	requestShipment.init();

</script>