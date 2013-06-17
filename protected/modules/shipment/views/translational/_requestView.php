<?php 
$baseUrl= Yii::app()->baseUrl;
?>

<div class="container" style ="margin-top:100px">
    <div class="row">
        
    <div class="errormsg" style="text-align:center; margin-bottom:50px"> </div>
    
    <div class="span12">
            <p class="pull-right"><input class="btn btn-primary btn-large" name ='sendRequestAvailability' value="Send request availability"/></p>
        </div>
    
    <form class="span12">
    <?php

    $this->widget("application.components.HtmlTable", array (
        'th'=> array ("SAMPLE ID" ,"VISIT","CENTRE","PATIENT","SAMPLE TYPE","SAMPLE NUMBER","COLLECTION DATE","CRYOVIALS","TEMPERATURE"," CHECK ALL  <input class='checkAll' type='checkbox'/>"),
        'data'=> $activeRecords,
        'td'=> $td,
        'id'=>"shipmentRequestTable",
        'extraTD' => array("<input type='checkbox' value='requested' name='REQUESTED[]'/>"),
    ));
    ?>
    </form>

    </div>

</div>

<script type="text/javascript">

var shipmentRequest = {
	init : function(){
            $("#shipmentRequestTable").dataTable
            ({
                "bJQueryUI" : true,
                "bPaginate":false,
                // "sPaginationType": "full_numbers",
                'aoColumnDefs': 
                    [
                        {"bSortable":false,"aTargets":[9]},
                        {"bVisible": false, "aTargets": [2]}
                    ],

                "fnDrawCallback": function ( oSettings )
                { 
                    if ( oSettings.aiDisplay.length == 0 )
                    {
                        return true;
                    }

                    var nTrs = $('#shipmentRequestTable tbody tr');
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
                            nCell.innerHTML = "<label>CENTRE: </label>"+sGroup ;
                            nGroup.appendChild( nCell );
                            nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                            sLastGroup = sGroup;
                        }
                    }
                }

            });

            shipmentRequest.setRequestEvent();
            shipmentRequest.setEventCheckAll();
	},

	setRequestEvent: function ()
        {
            $("input[name='sendRequestAvailability']").click(function()
            {
                shipmentRequest.markMaterialToShip();
                var $serialize = $("form").find(".checked").serialize();
                $("#QUERY-PROGRESS").dialog("open");
                var url="<?php echo Yii::app()->createUrl('shipment/translational/requestAvailability');?>";
                $.post(url,$serialize,function(request)
                {
                    $("#QUERY-PROGRESS").dialog("close");
                    if(request.status=='success')
                            $("#QUERY-SUCCESS").dialog("open",shipmentRequest.reloadPage());
                    else
                            $(".errormsg").html(request.errormsg);

                },'json');
            });
	},

	markMaterialToShip: function()
        {
            $("#shipmentRequestTable").find("input:checkbox").each(function(){
                    var $checked = $(this);
                    var html = $checked.parent().parent();
                    if ($checked.attr("checked"))
                            $(html).find("input[name='MATERIAL_ID[]']").addClass("checked");
                    else
                            $(html).find("input[name='MATERIAL_ID[]']").removeClass("checked");
            });
	},

	setEventCheckAll : function(){
		$("#shipmentRequestTable").delegate(".checkAll","click", function(){
			var $checked = $(this);
			if ($checked.attr("checked"))
				$("#shipmentRequestTable").find("input[name='REQUESTED[]']").prop("checked",true);
			else
				$("#shipmentRequestTable").find("input[name='REQUESTED[]']").prop("checked",false);
		});	
	},

	reloadPage: function(){
		setTimeout(function (){
			var url = '<?php echo Yii::app()->createUrl("shipment/translational/request"); ?>';
			$("#QUERY-SUCCESS").dialog("close");
			window.location=url;
		},1500);
	}
    }

    shipmentRequest.init();

</script>

