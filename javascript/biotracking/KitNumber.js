var KitNumber = 
{
	data : null,
	sampleKitID:null,
	kitNumberToInsert:null,
	kitNumberInserted:null,
	SelectMaterial:null,

	init:function()
	{
		KitNumber.setUpDialog();
	},

	setData:function(json)
	{
		KitNumber.data=json;
	},

	getKitNumber:function(patientID)
	{
		var valueToReturn;
		var taille=KitNumber.data.length;
		for (var i=0; i <taille; i++)
		{
			if (KitNumber.data[i]["PATIENT_ID"]==patientID)
					valueToReturn=KitNumber.data[i]["SAMPLE_KIT_ID"];
		}
		return valueToReturn;
	},

	/**
	*	return true si patient randomisé sinon false	
	*/
	isPatientRandomised:function(patientID)
	{
		var kit = KitNumber.findKitNumber("PATIENT_ID",patientID);

		if (KitNumber.sampleKitID==null || KitNumber.sampleKitID=='null')
			return false;
		else
			return true;
	},

	isKitNumberAlreadyInserted:function(patientID)
	{
		var kit = KitNumber.findKitNumber("PATIENT_ID",patientID);
		if (KitNumber.kitNumberInserted == null || KitNumber.kitNumberInserted =='null')
			return false;
		else
			return true;
	},

	insertKitNumber:function(patientID,kitNumber)
	{
		$.post("MVC/controllers/site/SaveKitNumber.php",{patientID:patientID,kitNumber:kitNumber},function(resultat)
		{
			if (resultat.status !== 'success')
					alert("An internal issue did occur therefore the system was unable to save the sample kit ID."+
						"\nHowever you can continue the registration of your sample.\n\nPlease accept our apology for that inconvenience.");
		},"json").complete(function(){
			KitNumber.SelectMaterial.kitNumberOk=true;
			getMaterialForm();
		});
	},

	findKitNumber:function(key, searchValue)
	{
		KitNumber.sampleKitID=null;
		var taille=KitNumber.data.length;
		for (var i=0; i <taille; i++)
		{
			if (KitNumber.data[i][key]==searchValue)
			{
				KitNumber.sampleKitID=KitNumber.data[i]["SAMPLE_KIT_ID"];
				KitNumber.kitNumberInserted=KitNumber.data[i]["KIT_ENTERED"];
			}
		}
	},

	checkKitNumber:function(SelectMaterial, kitNumberToInsert, patientID)
	{
		KitNumber.kitNumberToInsert=kitNumberToInsert;
		KitNumber.patientID=patientID;
		KitNumber.SelectMaterial=SelectMaterial;

		if ($.trim(KitNumber.kitNumberToInsert) !='')
        {
            if(KitNumber.isKitNumberAlreadyInserted(patientID) == false)
            {
            	var randoKitNumber = KitNumber.getKitNumber(patientID);
	            if ($.trim(kitNumberToInsert) != randoKitNumber)
	                	$("#sampleKitNumberConfirm").dialog("open");
	            else
	            {
	                KitNumber.insertKitNumber(patientID,kitNumberToInsert);
	                SelectMaterial.kitNumberOk=true;
	            }	
            }
            else
            	SelectMaterial.kitNumberOk=true;
        }
        // kit number obligatoire
        // else
        // 	SelectMaterial.kitNumberOk=true;

	},

	setUpDialog:function()
	{
		$("#sampleKitNumberConfirm").dialog(
		{
             width:520,
             modal: true,
             autoOpen:false,
             buttons :
             {
                "yes" : function ()
                {
                    KitNumber.insertKitNumber(KitNumber.patientID, KitNumber.kitNumberToInsert);
                    $(this).dialog("close");
                },
                "cancel" :function(){
                    $(this).dialog("close");
                }
             }
		});
	}

}