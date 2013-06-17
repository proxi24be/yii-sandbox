
<script type="text/javascript">

var url='<?php echo Yii::app()->createAbsoluteUrl("biotracking/her2form/localForm");?>';

function openLocalForm ()

{
    var _windowStyle = 'location=0,directories=0,status=0,menubar=1, scrollbars=1,resizable=1,copyhistory=0, width=1000, height=800';
    var _windowName = 'Aphinity Local form';
    var sampleID=$(".search").find("input[name='SAMPLE_ID']").val();
    var urlToOpen=url+"?sampleID="+sampleID;
    window.open(urlToOpen, _windowName, _windowStyle);
}

$(document).ready(function()
{
   $(".search").delegate("a.popup","click",function(event){
       event.preventDefault();
       openLocalForm();
   });
});

</script>

<?php 
$this->breadcrumbs=array(
	"maintenance local form"
);

$action = Yii::app()->createUrl("administration/biotracking/localform");

?>

<div class="search grid_12">
    <form action="<?php echo $action;?>" method="post">
    <label>sample ID</label>:<input name="SAMPLE_ID" type="text" value=""/>
    <input class="getLocalForm" name="search" type="submit" value="get local form"/> <a class="popup" href="#">show in popup windows</a>
    </form>
</div>

<div class="grid_12">

    <h3 class="title"> SAMPLE ID : <?php echo $sampleID ;?> </h3>

</div>

<div class="biotrackingLocalForm grid_12">
    
 <iframe id="iframeLocalForm" style ="margin-top:15px;" class="grid_12" height="1700" scrolling="no"  frameborder="0" marginheight="0" marginwidth="0" 
         src="<?php echo $urlIframeLocalForm ; ?>">
 </iframe>
 
</div>

<div class="clear"></div>