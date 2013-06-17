/* 
 * contient tous les paramètres que le user peut commander
 * 
 */
var reportParam = 
{
    memory:null,
    init :function(url)
    {
        reportParam.initUserParams(url);
    },
    
    initUserParams:function(url)
    {
        // Require the xhr module
        require(["dojo/_base/xhr","dojo/store/Memory"],
            function(xhr,Memory) {
            {
                // Execute a HTTP GET request
                $("#PAGE-LOADING").dialog("open");
                xhr.get({
                    // The URL to request
                    url:url,
                    handleAs:'json',
                    timeout:30000,
                    load: function(jsonResult) {
                        reportParam.memory= new Memory({data:jsonResult, idProperty: "userParam"});
                    },
                    handle:function()
                    {
                        $("#PAGE-LOADING").dialog("close");
                    },
                    error: function()
                    {
                        alert("All data were not loaded properly would you mind to reload your page if the issue still persists please contact breast.technical@bordet.be")
                    }
                    
                });
            }
        });
    },
    
    getOptionData:function (filters,options,orderAttribute)
    {
      var objOption = new Object;
      for (var toCompare in filters); // trouve tous les attributs de l'objet normalement il y en a qu'un
      reportParam.memory.query(function(object)
      {
            var match = false;
            for (var i=0;i<filters[toCompare].length && !match;i++)
                    match = object[toCompare]==filters[toCompare][i];  
        
        return match;
      },{sort:[{attribute:orderAttribute, descending: false}]}).forEach(function(data)
          {
                 objOption[data[options.id]]= data[options.text];
          });
      return objOption;
    }
}

var application =
{
    init : function(url)
    {
        application.setReportIDEvent(url);
    },
    
    setReportIDEvent:function(url)
    {
        $("div.form").delegate("#ReportForm_REPORT_ID","change",function()
        {
            var reportID=$("#ReportForm_REPORT_ID").val();
            $("p.reportDescription").text(reportDescription[reportID]);
            $("#PAGE-LOADING").dialog("open");
            $.get(url+"?reportID="+reportID,function(data)
            {
                $("div.form").find("div.reportDynamic").html(data);
            }).complete(function()
            {
                 $("#PAGE-LOADING").dialog("close");
            });
        });
    }
}

