<?php

$this->breadcrumbs=array(
	$this->module->id,"request availability"
);

?>

<div class="container" style="margin-top:25px;">
    <div class="row">
    
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id'=>"filterRequest",
)); 


$values = VStudies::model()->findAll("STUDY_ID NOT IN (1,2)");
$data = CHtml::listData($values,'STUDY_ID','STUDY');

echo "<div class='span2'>";
    echo CHtml::label ("STUDY", "STUDY_ID");
    echo CHtml::dropDownList ("STUDY_ID", "",MyUtils::addEmpty($data),array("class"=>"span2"));
echo "</div>";

echo "<div class='span2'>";
    echo CHtml::label ("COUNTRY", "COUNTRY_ID");
    echo CHtml::dropDownList ("COUNTRY_ID", "",array(), array(
            'ajax' => array (
                    'type' => 'POST',
                    'url' =>CController::createUrl('translational/dynamicCentre'),
                    'update' =>'#CENTRE_ID',
            ),
            'class' =>'tagsinput span2',
    ));
echo "</div>";

echo "<div class='span2'>";
    echo CHtml::label ("CENTRE", "CENTRE_ID");
    echo CHtml::dropDownList ("CENTRE_ID", "",array(), array(
            'ajax' => array (
                    'type' => 'POST',
                    'url' =>CController::createUrl('translational/dynamicVisit'),
                    'update' =>'#VISIT_ID',
            ),
            "class"=>"span2"
    ));
echo "</div>";

echo "<div class='span2'>";
    echo CHtml::label ("VISIT", "VISIT_ID");
    echo CHtml::dropDownList ("VISIT_ID", "",array(), array(
            'ajax' => array (
                    'type' => 'POST',
                    'url' =>CController::createUrl('translational/dynamicPatient'),
                    'update' =>'#PATIENT_ID',
            ),
            "class"=>"span2"
    ));
echo "</div>";

echo "<div class='span2'>";
    echo CHtml::label ("PATIENT", "PATIENT_ID");
    echo CHtml::dropDownList ("PATIENT_ID", "",array(),array("class"=>"span2"));
echo "</div>";

$url = Yii::app()->createUrl('shipment/translational/materialToShip');

echo "<div class='span2'>";
    echo CHtml::ajaxButton("FILTER",$url,
        array(
               'type'=>'POST',
               'data'=> 'js:$("#filterRequest").serialize()',
               'before'=>'js:$("#QUERY-PROGRESS").dialog("open")',
               'success'=>'js: function(data){$("#QUERY-PROGRESS").dialog("close"); $("#tableMaterialToShip").html(data);}',
        ),
        array(
                'id'=>'findMaterialToShip',
                'class'=>'button btn btn-primary',
        ));
    
echo "</div>";

$this->endWidget();

?>
    </div> <!--row-->
</div>    <!--container--> 
<script type="text/javascript">

var filter = {
    init: function(){
        $("button").button();
    }
}

var allSamples;

var materialToShip =
{
    loadAllData: function()
    {
        $("#STUDY_ID").change(function(){
            var url="<?php echo Yii::app()->createUrl("shipment/translational/getallsample");?>";
            $.post(url,"STUDY_ID="+$(this).val(),function(json){
                allSamples=json;
            },"json");
        });
    }
}

   filter.init(); 
   materialToShip.loadAllData();

</script>
    
</div>

<div style="margin-top:30px" id="tableMaterialToShip">
<!-- tableau à afficher -->
</div>