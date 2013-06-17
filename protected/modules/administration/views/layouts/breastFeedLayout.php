<?php
    $baseUrl= Yii::app()->request->baseUrl;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <title>BrEAST FEED ADMIN INTERFACE</title>
    <!-- The Br.E.A.S.T. is a cooperative clinical research group initiated by the Chemotherapy -->
    <?php 
        $path = Yii::getPathOfAlias("webroot.css.breast");
        $assetUrl = Yii::app()->assetManager->publish($path);
        Yii::app()->clientScript->registerCSSFile("$assetUrl/grid960.css" );
        Yii::app()->clientScript->registerCSSFile("$assetUrl/breast.css" );
        Yii::app()->clientScript->registerCSSFile("$assetUrl/reset.css");
    ?>
    
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/dojo/1.8/dijit/themes/claro/claro.css" media="screen">
    <script src="//ajax.googleapis.com/ajax/libs/dojo/1.8/dojo/dojo.js" data-dojo-config="async: true,parseOnLoad: true"></script>
    
</head>

<body class="claro">
    
<div id="page">
<div class="container_12 main">
    
    <div class="clear"></div>
    
    <!-- contenu principal -->
    <div id="main_content" style="min-height:700px">

    <?php echo $content; ?>

    </div>

    <hr/>
    
    <div class="clear"></div>
</div>

</div>
</body>

</html>

