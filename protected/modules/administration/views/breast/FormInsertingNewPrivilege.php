<style>
    table#tableNewCentre 
    {
        width: 100%;
    }
    
    form#formTableNewCentre input
    {
        border:none;
    }
    
    table#tableNewCentre td, table#tableNewCentre th
    {
        text-align: center;
    }
</style>

<?php
        if (!isset ($userInfo)):
            echo "<div class='alert span3'>Sorry that user does not exist</div>";
        else:
?>

<div class="span12">
    
    <h3>Please use the search function to filter the sites</h3>

    <input style ="float:right" type="submit" value="add new sites" onclick="submitNewSite()"/>

    <form id="formTableNewCentre form-inline">

        <input type="hidden" readonly="readonly" name="USERNAME" value='<?php echo $userInfo->USERNAME;?>'/>
        <input type="hidden" readonly="readonly" name="USER_ID" value='<?php echo $userInfo->USER_ID;?>'/>
        <input type="text"  readonly="readonly" name="FIRSTNAME" value='<?php echo $userInfo->FIRSTNAME;?>'/>
        <input type="text" readonly="readonly" name="LASTNAME" value='<?php echo $userInfo->LASTNAME;?>'/>
        <input type="text" readonly="readonly" name="EMAIL" size="50" value='<?php echo $userInfo->EMAIL_ADDRESS;?>'/>
        <input type="text" readonly="readonly" name="ROLE_SPONSOR_NAME" value='<?php echo $userInfo->ROLE_DESCRIPTION;?>'/>
        <input type="hidden" readonly="readonly" name="ROLE_STUDY_ID" value='<?php echo $userInfo->ROLE_STUDY_ID;?>'/>

        <p>Please select the environment:</p>
        <div class="span1">
            <label class="radio"><input type="radio" name="environment" value="prod" checked="checked" />prod</label>
        </div>
        <div class="span1">
            <label class="radio"><input type="radio" name="environment" value="test" />test</label>
        </div>
        
        <div class="clearfix"></div>
            
        
        <table id="tableNewCentre">
            <thead>
            <th>STUDY</th><th>STUDY ID</th><th>COUNTRY</th><th>COUNTRY ID</th><th>CENTRE</th><th>CENTRE ID</th>
            </thead>

            <tbody>
                <!-- insertion des elements avec javascript -->
            </tbody>
        </table>
    </form>
    
    <?php
         endif;
    ?>
</div>
    
    
<div id="CONFIRM_NEW_SITES" class="dialog" title="Confirm new sites">
    <p>Warning you are going to assign <b><span></span></b> site(s) to that user.</p>
    <p>Do you want to confirm ?</p>
</div>


<script type="text/javascript">
    var table =
    {
        data:<?php echo CJSON::encode($sites);?>,
        td:["STUDY","STUDY_ID","COUNTRY","COUNTRY_ID","CENTRE","CENTRE_ID"],
        init :function()
        {
            table.insertData();
            table.renderTable();
        },
        insertData:function()
        {
            for (var i=0; i<table.data.length;i++)
                $("table#tableNewCentre tbody").append(table.createRow(table.data[i]));
        },
        createRow:function(row)
        {
            var tr=document.createElement("tr");
            for (var i=0; i <table.td.length;i++)
            {
                var td=document.createElement("td");
                td.innerHTML=row[table.td[i]] + "<input type='hidden' name='"+table.td[i]+"[]' value='"+row[table.td[i]]+"'/>";
                tr.appendChild(td);
            }
            return tr;
        },
        renderTable:function()
        {
            $("table#tableNewCentre").dataTable
           ({
               "bJQueryUI" : true,
               "sPaginationType": "full_numbers",
               "aaSorting": [], //no initial sorting
               "bPaginate":false,
               'aoColumnDefs':
                    [
                       {"bSortable":false,"aTargets":[0,1,3,5]}
                    ]
           });
        },
        insertNewPrivileges:function()
        {
            var serialize = $("form").serialize();
            var url='<?php echo Yii::app()->createUrl("administration/breast/insertSpecialPrivilege");?>';
            $.post(url,serialize,function(data)
            {
                  alert (data);
            });
        }
    }
    
    function submitNewSite()
    {
        var totalToInsert= $("form tbody").find("tr").length;
        $("#CONFIRM_NEW_SITES").find("span").html(totalToInsert);
        $("#CONFIRM_NEW_SITES").dialog("open");
    }
    
    $("#CONFIRM_NEW_SITES" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            autoOpen:false,
            buttons: {
                "Continue": function() {
                    $(this).dialog("close");
                    table.insertNewPrivileges();
                },
                "Cancel": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    
    table.init();

</script>
