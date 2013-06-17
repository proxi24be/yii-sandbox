<script type="text/javascript">
var ventanaForm={

	init : function()
	{
		$("#VentanaForm").find("input").addClass("ui-corner-all ui-state-hover")
		$("#VentanaForm").find("button").button();
	}
};

$(document).ready(function(){
	ventanaForm.init();
});
</script>

<style>
    
    h2{
        text-align: center;
    }    
    
</style>

<div class="clForm">
    
<h2>APHINITY CENTRAL LAB ANALYSIS VENTANA PART</h2>

<div class="siteInformation">    
<?php

//if ($contactDetails !== null)
//{
//     echo "<h3 class='H3MENU'>Centre information</h3>";
//     echo "<ul>";
//     echo "<li>" . CHtml::label("Country:","") .  "<span>".$contactDetails[0]['COUNTRY']."</span></li>";
//     echo "<li>" . CHtml::label("Centre no:","") . "<span>".$contactDetails[0]['SHORT_DESCRIPTION']."</span></li>";
//     echo "<li>" . CHtml::label("Name of Hospital:","") . "<span>".$contactDetails[0]['LONG_DESCRIPTION']."</span></li>";
//     echo "<li>" . CHtml::label("Town:","") . "<span>".$contactDetails[0]['ADDRESS_CITY']."</span></li>";
//     echo "<li>" . CHtml::label("Investigator's Name:","") ."<span>".$contactDetails[0]['CONTACT_PERSON'] ."</span></li>";
//     echo "<li>" . CHtml::label("Investigator's Fax no:","")."<span>" .$contactDetails[0]['FAX_NUMBER'] ."</span></li>";
//     echo "<li>" . CHtml::label("Patient number:","") ."<span>".$contactDetails[0]['SCREENING_NUMBER'] ."</span></li>";
//     echo "<li>" . CHtml::label("Local pathological number:","") ."<span>".$contactDetails[0]['LOCAL_ID'] ."</span></li>";
//     echo "<li>" . CHtml::label("Collection date:","") ."<span>".$contactDetails[0]['COLLECTION_DATE'] ."</span></li>";
//     echo "<li>" . CHtml::label("Shipment date:","") ."<span>".$contactDetails[0]['DATE_PICKUP'] ."</span></li>";
//     echo "</ul>";
//}

?>
</div>

<h3 class="H3MENU">Ventana central lab results</h3>

<div class="form ui-widget">
	<?php 

	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'VentanaForm',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		// 'action'=>$url
	)); 

	echo $form->hiddenField($ventanaModel,'materialID',array("value"=>(int)$materialID)); 
	echo $form->error($ventanaModel,'materialID'); 
	?>

		<div class="row">
		<h3>IHC tested with Ventana kit</h3>
		<?php 
			echo $form->radioButtonList($ventanaModel,'ihcVentana',array("0"=>"0","1+"=>"1+","2+"=>"2+","3+"=>"3+","Not interpretable"=>"Not interpretable")); 
			echo $form->error($ventanaModel,'ihcVentana'); 
		?>
		</div>

		<div class="row">
		<h3>HER2 ISH tested with Ventana kit</h3>
		<?php 
			echo $form->radioButtonList($ventanaModel,'ishVentanaResult',array("Amplified"=>"Amplified","Not amplified"=>"Not amplified","Not interpretable"=>"Not interpretable")); 
			echo $form->error($ventanaModel,'ishVentanaResult'); 
		?>
		</div>

		<div class="row">
		
		<?php 
			echo Chtml::label("Dual Colour ISH HER2/neu/Chromosome 17 Ratio:","");
			echo $form->textField($ventanaModel,'ventanaIshChr17Unit',array("size"=>"3")); 
			echo $form->textField($ventanaModel,'ventanaIshChr17Decimal',array("size"=>"3")); 
			echo $form->error($ventanaModel,'ventanaIshChr17Unit'); 
			echo $form->error($ventanaModel,'ventanaIshChr17Decimal',array("size"=>"3")); 
		?>
		</div>

		<div class="row">
		
		<?php 
			echo Chtml::label("Dual colour ISH HER2 gene copy number:","");
			echo $form->textField($ventanaModel,'ventanaIshCopynb',array("size"=>"3")); 
			echo $form->error($ventanaModel,'ventanaIshCopynb'); 
		?>
		</div>

		<div class="row buttons">
		<button style="font-size:10pt; margin-left:300px">submit</button>
		</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->

</div>

    



    


