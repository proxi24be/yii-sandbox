<h3 class="title">Clinical Trials Overview</h3>

<?php
$max=count($studies);
$count=0;
foreach($studies as $study)
{
	$url=Yii::app()->createUrl("site/trials",array("s"=>$study->ID));	
	echo "<div class='grid_9 studyDescription'>";
	echo "<p><b>$study->LONG_NAME</b></p>";
	echo "<p>$study->DESCRIPTION</p>";
	echo "<p><a href='$url'>More information on this trial</a></p>";
        echo "</div>";
        if (++$count <$max)
            echo "<hr/>";
}


?>