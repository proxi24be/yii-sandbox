<script type="text/javascript">

$(document).ready(function(){
    
    $( "#tabs" ).tabs({
            ajaxOptions: {
                error: function( xhr, status, index, anchor ) {
                    $( anchor.hash ).html(
                        "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                        "If this wouldn't be a demo." );
                }
            }
    });
})


</script>


<div id="tabs" class="redmond">
    <ul>
        <li><a href="/breast_yii/index.php/shipment/translational/request">Request availability</a></li>
        <li><a href="">List of requested samples</a></li>
        <li><a href="">??????</a></li>
    </ul>
</div>