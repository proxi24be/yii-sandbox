var AphinityValidationRule=
{
    setValidationRule:function()
    {
        this.sizeInvCompEvent();
        this.pathologicalStageEvent();
        this.IHCPositivityEvent();
    },
    
    displayMessageIfNotValidPatternAndReturnFlag:function(CutoffValue,message)
    {
        if (CutoffValue.isValidPattern())
            return true;
        else
        {
            return false;
        }
    },
    
    displayAllWarningMessage:function()
    {
      this.pathologicalStageBusiness();
      this.sizeInvCompBusiness();
      this.IHCPositivityBusiness();
    },
    pathologicalStageEvent:function()
    {
        $(AphinityToolTip.tips.pathologicalStage.id).change(function()
        {
               AphinityValidationRule.pathologicalStageBusiness();
        });
    },
    
    pathologicalStageBusiness:function()
    {
        try
        {
            var pathologicalStage=$(AphinityToolTip.tips.pathologicalStage.id).val();
            if (pathologicalStage== "Stage IIIB")
                AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.pathologicalStage.id,AphinityToolTip.tips.pathologicalStage.classID,AphinityToolTip.tips.pathologicalStage.warningMessageIIIB);
            else
                AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.pathologicalStage.classID);
        }
        catch (err)
        {
            
        }
    },
    
    sizeInvCompEvent:function()
    {
        $(AphinityToolTip.tips.sizeInvComp.id).focusout(function()
        {
           AphinityValidationRule.sizeInvCompBusiness();
        });
    },
    
    sizeInvCompBusiness:function()
    {
        try
        {
            var sizeInvComp=$(AphinityToolTip.tips.sizeInvComp.id).val();
            var val=parseFloat(sizeInvComp);
            if (val<0)
                AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.sizeInvComp.id,AphinityToolTip.tips.sizeInvComp.classID,AphinityToolTip.tips.sizeInvComp.warningMessageSizeBelow0);
            else if (val >50)
                AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.sizeInvComp.id,AphinityToolTip.tips.sizeInvComp.classID,AphinityToolTip.tips.sizeInvComp.warningMessageSizeGreater50);
            else
                AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.sizeInvComp.classID);
        }
        catch(err)
        {
            
        }
    },
    
    IHCPositivityEvent:function()
    {
        $(AphinityToolTip.tips.IHCCellPos.id).focusout(function()
        {
            AphinityValidationRule.IHCPositivityBusiness();
        });
    },
    
    IHCPositivityBusiness:function()
    {
        try
        {
            var IHCLocalGuidelines = $("#AphinityLocalForm_IHCLocalGuidelines").find("option:selected").val();
            var IHCPositivity=$("#AphinityLocalForm_IHCPositivity").find(":checked").val();
            IHCLocalGuidelines=IHCLocalGuidelines.toUpperCase();
            IHCPositivity=IHCPositivity.toUpperCase();
            var value=$(AphinityToolTip.tips.IHCCellPos.id).val();
            if (value)
            {
                CutoffValue.setValue(value);
                if (IHCPositivity.indexOf("ASCO/CAP")!==-1)
                {
                    if (IHCLocalGuidelines.indexOf("NEGATIVE")!==-1)
                    {
                        if (CutoffValue.convertCutOffValue()>30)
                             AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.IHCCellPos.id, AphinityToolTip.tips.IHCCellPos.classID, AphinityToolTip.tips.IHCCellPos.warningMessageAsco);
                        else
                             AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
                    } 
                    else if (IHCLocalGuidelines.indexOf("POSITIVE")!==-1)
                    {
                        if (CutoffValue.convertCutOffValue()<30)
                             AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.IHCCellPos.id, AphinityToolTip.tips.IHCCellPos.classID, AphinityToolTip.tips.IHCCellPos.warningMessageAsco);
                         else
                             AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
                    }    
                    else;
                }
                else if (IHCPositivity.indexOf("APPROVED LABEL")!==-1)
                {
                    if (IHCLocalGuidelines.indexOf("NEGATIVE")!==-1 )
                    {
                        if (CutoffValue.convertCutOffValue()>10)
                             AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.IHCCellPos.id, AphinityToolTip.tips.IHCCellPos.classID, AphinityToolTip.tips.IHCCellPos.warningMessageApprovedLabel);
                         else
                             AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
                    }

                    else if (IHCLocalGuidelines.indexOf("POSITIVE")!==-1)
                    {
                        if (CutoffValue.convertCutOffValue()<10)
                             AphinityToolTip.displayWarningMessage(AphinityToolTip.tips.IHCCellPos.id, AphinityToolTip.tips.IHCCellPos.classID, AphinityToolTip.tips.IHCCellPos.warningMessageApprovedLabel);
                         else
                             AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
                    }
                    else;
                }
                else
                    AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
            }
            else
                AphinityToolTip.removeWarningMessage(AphinityToolTip.tips.IHCCellPos.classID);
        }
        catch (err)
        {
            
        }
        
    }
}

