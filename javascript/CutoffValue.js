var CutoffValue=
{
    value:null,
    setValue:function(value)
    {
        CutoffValue.value=value.replace(" ","");
        CutoffValue.value=CutoffValue.value.replace(",",".");
    },
    
    isValidPattern:function()
    {
        var pattern=/^(([><]=?|[><]?)\d)/g;
        return pattern.test(CutoffValue.value);
    },
    
    acceptNA:function()
    {
        var pattern=/^na$/i;
        return pattern.test(CutoffValue.value);
    },
    convertCutOffValue:function()
    {
        var patternAbove=/>\d+/g;
        var patternBelow=/<\d+/g;
        var valueToReturn=CutoffValue.value;
        
        if (patternAbove.test(valueToReturn))
        {
            valueToReturn = valueToReturn.replace(">","");
            valueToReturn=parseFloat(valueToReturn) + 0.01;
        }
        
        else if (patternBelow.test(valueToReturn))
        {
            valueToReturn = valueToReturn.replace("<","");
            valueToReturn=parseFloat(valueToReturn)-0.01;
        }
        
        else
        {
            valueToReturn = valueToReturn.replace(">","");
            valueToReturn = valueToReturn.replace("=","");
            valueToReturn = valueToReturn.replace("<","");
            valueToReturn=parseFloat(valueToReturn);
        }
        
        return valueToReturn;
    }
    
}

