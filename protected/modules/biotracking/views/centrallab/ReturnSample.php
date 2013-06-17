<script type="text/javascript">

var filter = {
    init: function(){
        $("button").button();
    }
}

$(document).ready (function(){
   filter.init(); 
});

</script>

<style>

label {
    margin-left : 15px;
}

.button{
    margin-left:15px;
}

</style>


<div>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id'=>"filterReturnSample",
)); 


$data = CHtml::listData($oCDbDataReader,'CENTRE_ID','CENTRE_DESCRIPTION');

echo CHtml::label ("CENTRE:", "CENTRE");
echo CHtml::dropDownList ("CENTRE_ID", "",MyUtils::addEmpty($data),array(
        
));

echo CHtml::ajaxButton("FILTER",'GetTableSampleReturn',
        array(
               'type'=>'POST',
               'data'=> 'js:$("#filterReturnSample").serialize()',
               'before'=>'js:$("#QUERY-PROGRESS").dialog("open")',
               'success'=>'js: function(data){$("#QUERY-PROGRESS").dialog("close"); $("#tableReturnSample").html(data);}',
        ),
        array(
                'id'=>'findTissueToReturn',
                'class'=>'button'
        ));

$this->endWidget();

?>

</div>

<div style="margin-top:30px" id="tableReturnSample">
<!-- tableau à afficher -->
</div>
