<?php 
$this->breadcrumbs=array(
	"insert special user privileges"
);

?>

<div class="container">
    <div class="row">
        <p class="findUser span12"><input type="text" name="username" value="username" size="40"/> <input type="submit" id="findUser" value="find user"/></p>        
    </div>
</div>


<div class="container" id="newUserPrivilege">
    <div class="row">
        
        
    </div>
</div>

<script type="text/javascript">
    
    
    $("#findUser").click(function(event)
    {
        event.preventDefault();
        var url='<?php echo Yii::app()->createUrl("administration/breast/GetFormForInsertingNewPrivilege");?>';
        var username=$("p.findUser").find("input[name='username']").val();
        $("#PAGE-LOADING").dialog("open");
        $.get(url,"username="+username,function(form)
        {
            $("#newUserPrivilege").find("div").html(form);
        }).complete(function()
        {
            $("#PAGE-LOADING").dialog("close");
        });
    });
    
</script>
    


