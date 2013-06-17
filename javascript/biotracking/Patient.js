var Patient = 
{
    data : null,
    visits:null,
    sampleTypes:null,
    setData:function(json)
    {
        Patient.data=json;
    },

    setScreeningNumber : function ()
    {
        var taille=Patient.data.length;
        var option = "<option  value='0'></option>";
        for (var i=0; i <taille; i++)
                option =  option + "<option value='"+Patient.data[i]["PATIENT_ID"]+"'>"+Patient.data[i]["SCREENING_NUMBER"]+"</option>";

        $("form#materialForm").find("select[name='PATIENT_ID']").html(option);
    },

    setBirthDate:function()
    {
        var patientID= $("form#materialForm").find("select[name='PATIENT_ID']").val();
        var birthdate = Patient.getBirthDate(patientID);
        if (birthdate != null && birthdate !='null')
        {
            var d= Date.parse(birthdate);
            // la date minimum doit être en 1930
            $("#BIRTHDATE_DD_MM_YYYY").val(d.toString("dd/MM/yyyy"));
            $("#BIRTHDATE_DD_MMM_YYYY").val(d.toString("dd/MMM/yyyy"));

        }
        else
            $("div.birthdate").find("input").val("");

        $("div.birthdate").fadeIn(1500);
    },

    getBirthDate:function(patientID)
    {
        var birthdate=null;
        var taille=Patient.data.length;
        for (var i=0; i <taille; i++)
        {
            if (Patient.data[i]["PATIENT_ID"]==patientID)
                birthdate= Patient.data[i]["BIRTHDATE"];
        }

        return birthdate;
    },

    setVisit:function(patientID,url,idVisit)
    {
        $.get(url, {patientID:patientID},function(json){
            Patient.visits=json;
        },"json").complete(function()
        {
            var taille=Patient.visits.length;
            var option = "<option  value='0'></option>";
            for (var i=0; i <taille; i++)
                option =  option + "<option value='"+Patient.visits[i]["VISIT_ID"]+"'>"+Patient.visits[i]["VISIT_NAME"]+"</option>";
            
            $(idVisit).html(option);
        });
    },
    
    setSampleType:function(patientID,visitID,url,idSampleType)
    {
        $.get(url, {patientID:patientID, visitID:visitID},function(json){
            Patient.sampleTypes=json;
        },"json").complete(function()
        {
            var taille=Patient.sampleTypes.length;
            var option = "<option  value='0'></option>";
            for (var i=0; i <taille; i++)
                option =  option + "<option value='"+Patient.sampleTypes[i]["MATERIAL_TYPE"]+"'>"+Patient.sampleTypes[i]["DESCRIPTION"]+"</option>";
            
            $(idSampleType).html(option);
        });
    }

}