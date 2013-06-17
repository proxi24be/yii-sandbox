<script type="text/javascript">

var editor=
{
    WYSIWYG:null,
    init :function()
    {
        editor.newEditor();
        editor.setSubmitEvent();
    },

    setSubmitEvent:function()
    {
        require(["dojo/on", "dojo/dom"],
        function(on, dom)
        {
            var myButton = dom.byId("submitNewFeed");
            on(myButton, "click", function(evt){
                editor.saveNewFeed(editor.WYSIWYG.value);
            });
        });
    },
    
    saveNewFeed:function(texthtml)
    {
        var url='<?php echo Yii::app()->createUrl("administration/breastfeed/addNewFeed");?>';
        require(["dojo/request"], 
            function(request){
                request.post(url, {
                data: {newfeed:texthtml}                
            }).then(function(text){
                if (text=="ok")
                    alert("the news has been saved");
                else
                    alert("an error has occured");
            });
        });
    },
    
    newEditor:function()
    {
        require(["dijit/Editor","dijit/_editor/plugins/TextColor","dijit/_editor/plugins/FontChoice","dijit/_editor/plugins/Print"],function(Editor){
            editor.WYSIWYG=new Editor({
                plugins: ["bold","italic","|","cut","copy","paste","|","insertUnorderedList"],
                extraPlugins:["foreColor","hiliteColor","fontName","fontSize","print"]
            }, "WYSIWYG");
        });
    }
}
</script>

<div class="grid_9 " style="margin-top:50px">

<div id="WYSIWYG"></div>

</div>

<div class="grid_3 omega">
    <button id="submitNewFeed">submit new feed</button>
</div>

<script>
        // Include the class
       // Load the editor resource
        require(["dojo/domReady!"], function(){
            editor.init();
    });
        
</script>
