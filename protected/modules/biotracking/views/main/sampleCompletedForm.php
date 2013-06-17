<div class="smoothness tabCompletedForm">

    <?php
        $this->widget('application.views.widget.jquery-ui.Tab', array("tabs"=>$tab,'id'=>"myTabSampleCompletedForm","class"=>"nothingToDo"));
    ?>

</div>


<script type="text/javascript">
    
    $(document).ready (function(){
        $( "div.tabCompletedForm" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				},
                                beforeSend: function(){
                                    $("#PAGE-LOADING").dialog("open");
                                },
                                complete: function(){
                                    $("#PAGE-LOADING").dialog("close");
                                }
			}
		});
    });
    
</script>

