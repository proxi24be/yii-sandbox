<?php
$baseUrl= Yii::app()->request->baseUrl;
?>
<!DOCTYPE HTML>
<html lang="en">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<?php 

$path = Yii::getPathOfAlias("webroot.css.breast");
$assetUrl = Yii::app()->assetManager->publish($path);
Yii::app()->clientScript->registerCSSFile("$assetUrl/grid960.css" );
Yii::app()->clientScript->registerCSSFile("$assetUrl/breast.css" );
Yii::app()->clientScript->registerCSSFile("$assetUrl/reset.css");
//Yii::app()->clientScript->registerCSSFile("$assetUrl/userForm.css");
Yii::app()->clientScript->registerCoreScript('jquery');

?>
<title>local form</title>

<style>
    
    div.form div.error input,
    div.form div.error textarea,
    div.form div.error select,
    div.form input.error,
    div.form textarea.error,
    div.form select.error
    {
        background: #FEE;
        border-color: #C00;
    }
    
    div.form .errorMessage
    {
        color: red;
        font-size:0.9em;
        font-style: italic;
    }
</style>

<body>

<div id="page">

    <div class="container_12 main">

        <div class="clear"></div>

        <!-- contenu principal -->
        <div id="main_content" style="min-height:700px">

        <?php echo $content; ?>

        </div>
        
        <div class="clear"></div>

    </div>

</div>

</body>

</html>