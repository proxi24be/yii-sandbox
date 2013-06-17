var SampleNumber =

{
	data :null,

	setData:function(json)
	{
		SampleNumber.data=json;
	},

	/*
		return -1 if not found
	*/
	getSampleNumber:function(visitID,materialTypeID)
	{
		var length=SampleNumber.data.length;
		var i=0;
		var found=false;
		var sampleNumber=-1;
		while (!found && i < length)
		{
			if (SampleNumber.data[i]["MATERIAL_TYPE_ID"]==materialTypeID && SampleNumber.data[i]["VISIT_ID"]==visitID)
			{
				found=true;
				sampleNumber=SampleNumber.data[i]["SAMPLE_NUMBER"];
			}
			else
				i++;
		}
		return sampleNumber;
	}

	/*getMaterialType:function(visitID)
	{
		var length=SampleNumber.data.length;
		var found=false;
		var materialType=new Array();
		for (var i=0,j=0; i<lenght;i++)
			{
				if (SampleNumber.data[i]["VISIT_ID"]==visitID)
				{
					materialType[j]["text"]=SampleNumber.data[i]["MATERIAL_TYPE"];
					j++;
				}
			}

		return materialType.sort();	
	},

	setMaterialType:function ()
	{
		var option="<option  value='0'></option>";
		var selectedVisit = $("#LIVISIT select").val();
		var materialTypes= SampleNumber.getMaterialType(selectedVisit);
		for 
        showLi("LIMATERIAL",option);
	}*/

}