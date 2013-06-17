/**
 *      prérequis la librairy jquery ui > 1.9 doit être chargé au préalable 
 *      les ID des balises suivent la convention du framework YII 
 */
var AphinityToolTip = 
{
    tips:{sizeInvComp:{id:"#AphinityLocalForm_sizeInvComp",title:"Please specifiy the size in mm",
                        warningMessageSizeBelow0:"Size of invasive component must be reported in millimetres (mm), please correct or confirm",
                        warningMessageSizeGreater50:"Size of invasive component present in the embedded tumour is more than 50 mm, please correct or confirm",
                        classID:"warning_sizeInvComp"},
          pathologicalStage:{id:"#AphinityLocalForm_pathologicalStage",
                            warningMessageIIIB:"Stage IIIB includes T4 tumours which are not eligible as per exclusion criteria 3, please correct or confirm",
                            classID:"warning_pathologicalStage"},
            IHCCellPos:{id:"#AphinityLocalForm_IHCCellPos",
                        warningMessageAsco:"Reminder: ASCO/CAP guidelines define as positive 3+ membrane staining in > 30% of invasive cells, please correct where applicable or confirm",
                        classID:"warning_IHCCellPos", 
                        warningMessageApprovedLabel:"which message should be displayed ?"}
    },
    
    init :function()
    {
        this.setTootlTip();
        $(document).tooltip();
    },
    
    setTootlTip:function()
    {
        $(this.tips.sizeInvComp.id).attr("title",this.tips.sizeInvComp.title);
    },
    displayWarningMessage:function(ID,classID,message)
    {
        var htmlElement=AphinityToolTip.createWarningElement(message,classID);
        AphinityToolTip.removeWarningMessage(classID);
        $(ID).parents("div.oneQuestion").append(htmlElement);
    },
    removeWarningMessage:function(classID)
    {
        $(".container_12").find("."+classID).remove();
    },
    createWarningElement:function(message,classID)
    {
        return "<li class='warningTooltip "+classID+"'><span class='ui-icon ui-icon-info' style='float:left'></span>"+message+"</li>";
    }
}