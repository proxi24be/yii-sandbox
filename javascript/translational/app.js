var translationalShipment = {
    init : function ()
    {
        $("#secondary").delegate ("a","click",function(event)
        {
            if ($(this).attr("id")=='requestedSample')
            {
                $("#QUERY-PROGRESS").dialog("open");
                $.get(urlRequestedSample,function(data){
                    {
                        $("#content").html(data);
                        $("#QUERY-PROGRESS").dialog("close");
                    }
                });
            }
            else if ($(this).attr("id")=='requestShipment')
            {
                $("#QUERY-PROGRESS").dialog("open");
                $.get(urlRequestedShipment,function(data){
                    {
                        $("#content").html(data);
                        $("#QUERY-PROGRESS").dialog("close");
                    }
                });	
            }
            else;

        });

        $("#secondary").delegate("a","click",function(event)
        {
            $("#secondary").find("li").removeClass("current");
            $(this).parent().addClass("current");
        });

       $("#primary").delegate("a","click",function(event)
       {
            $("#primary").find("li").removeClass("current");
            $(this).parent().addClass("current");
       });
   }
}