<?php 
$this->breadcrumbs=array(
	"All internal user accounts"
);

?>
<div class="container">
    <div class="row">
        <p class="findUser span12">
            <input type="text" name="username" value="Leave this field empty to display all internal users" size="50"/> <input type="submit" id="findUser" value="find user"/>
        </p>

        <div id="internalAccountAccess">
    
        </div>
    </div>
</div>


<script type="text/javascript">
    
    $("input[name='username']").click(function()
    {
        $(this).val("");
    });
    
    $("#findUser").click(function(event)
    {
        event.preventDefault();
        var url='<?php echo Yii::app()->createUrl("administration/breast/GetListAccessOfInternalUsers");?>';
        var username=$("p.findUser").find("input[name='username']").val();
        $("#PAGE-LOADING").dialog("open");
        $.get(url,"username="+username,function(form)
        {
            $("#internalAccountAccess").html(form);
        }).complete(function()
        {
            $("#PAGE-LOADING").dialog("close");
        });
    });
    
</script>
