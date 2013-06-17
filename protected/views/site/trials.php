<?php
$baseUrl = Yii::app()->baseUrl;
$this->breadcrumbs=array(
	'Trials',
);
?>

<div class="container">
    
    <div class="row-fluid">
        
        <div class="span9" style="text-align:justify">
        <?php
                        if (!empty($studyName))
                                echo utf8_encode("<h3>$studyName</h3>");

                        echo utf8_encode($content);

                        echo "<p style='margin-top:20px'>$back</p>";
        ?>

        </div>

        <div id="trials_right" class="span3" style="text-align:right; font-size:12px;">
                <h3><b>Clinical Trials</b></h3>		
                        <?php
                                foreach ($studies as $study)
                                {
                                        $url=Yii::app()->createUrl("site/trials",array("s"=>$study->ID));	
                                        echo "<a href='$url'> $study->SHORT_NAME</a><br/>";
                                }

                        ?>
        </div>
        
    </div>
    
</div>

