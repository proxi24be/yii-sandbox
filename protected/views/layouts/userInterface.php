<?php
	$baseUrl = Yii::app()->request->baseUrl;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin-theme/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin-theme/datatables.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatable/demo_page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin-theme/buttons.css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui/redmond/redmond.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui/aristo/Aristo.css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui/smoothness/smoothness.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminica/theme_blue.css" />
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"> </script>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"> </script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/datatables-1.8.1/jquery.datatables.min.js">
    </script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/translational/app.js">
    </script>

    <script type="text/javascript">

    $(document).ready(function(){
          translationalShipment.init();
          $( "#QUERY-PROGRESS" ).dialog({
                height: 140,
                modal: true,
                autoOpen:false
          });

          $( "#QUERY-SUCCESS" ).dialog({
                height: 140,
                modal: true,
                autoOpen:false
          });

          
    });

    </script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div id="gradient">
      <div id="stars">
        <div id="container">
        <header>
          
            <!-- User info -->
            <div id="userinfo">

              <div class="intro">

                Welcome <?php echo Yii::app()->user->fullName; ?><br />
                User profile : <?php echo Yii::app()->user->profile; ?>

              </div>
            </div>
        </header>
        
          <!-- The application "window" -->
          <div id="application">
            <!-- Primary navigation -->
            <nav id="primary">
              <?php 

                $ars=VStudyBrEASTTools::model()->findAll("ROLE_STUDY_ID=:roleStudyID",array(":roleStudyID"=>(int)Yii::app()->user->roleStudyID));
                $this->widget("application.components.TopMenu",array("applications"=>$ars));

              ?>
            </nav>

            <!-- Secondary navigation -->
            <nav id="secondary">
              <!-- <ul>
                <li class="current"><a href='<?php echo Yii::app()->createUrl("shipment/translational/request") ;?>'>1. Request availability</a></li>
                <li><a id="requestedSample" href="#">2. Pending sample availability</a></li>
                <li><a id="requestShipment" href="#">3. Sample confirmed for shipment</a></li>
              </ul> -->
            </nav>
          
            <!-- The content -->
            <section id="content" class="ui-corner-all">

            	<?php echo $content ?>

            </section>
         <!-- application -->
          </div>
        
          <footer id="copyright"> BrEAST <?php echo date('Y');?> - All rights reserved.<br/>
            
          </footer>
        <!-- end container -->
        </div>
      <!-- end stars -->
      </div>
    <!-- end gradient -->
    </div>
</body>

</html>

<div  id="QUERY-PROGRESS" title="Query in process">
        <p style="text-align:center">Please Wait – Query In Progress</p>
</div>
    
<div  id="QUERY-SUCCESS" title="Success">
        <p style="text-align:center">Thank you – the query has been successfully submitted</p>
</div>