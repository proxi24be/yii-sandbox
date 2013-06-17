<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--[if lte IE 8]>
          <script>
            document.createElement('ng-include');
            document.createElement('ng-pluralize');
            document.createElement('ng-view');
            document.createElement('ng:include');
            document.createElement('ng:pluralize');
            document.createElement('ng:view');
          </script>
        <![endif]-->

    <!--[if lte IE 8]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/json3/3.2.4/json3.min.js"></script>
    <![endif]-->

    <title>BrEAST website</title>
    <!-- The Br.E.A.S.T. is a cooperative clinical research group initiated by the Chemotherapy -->
    
    <?php 
        Yii::app()->clientScript->registerPackage('jquery');
        Yii::app()->clientScript->registerPackage('bootstrap');
        Yii::app()->clientScript->registerPackage('jquery-ui');
    ?>


    <style>
    body 
    {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        /*background-color: #EFEFEF;*/
    }
    
    span.required
    {
        color:red;
    }
    
    div.myError
    {
        margin-top:5px;
        width:200px;
    }
    
    p.dialog-text
    {
        text-align: center;
    }

    div.page div.container
    {
        background-color: #ffffff;
        padding-left: 10px;
        padding-right: 10px;
    }

    </style>
    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
</head>

<body>
    <div id="QUERY-PROGRESS" class="dialog" title="Query in process">
	<p class="dialog-text">Please Wait – Query In Progress</p>
    </div>

    <div id="PAGE-LOADING"  class="dialog" title="Page is loading">
            <p class="dialog-text">Please Wait – the page is loading</p>
    </div>
    
    <script type="text/javascript">
    
    $( "#QUERY-PROGRESS" ).dialog(
        {
             height: 140,
             modal: true,
             autoOpen:false
	});
        
        $( "#PAGE-LOADING" ).dialog(
        {
             height: 140,
             modal: true,
             autoOpen:false
	});
    
    </script>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
           <!--  <span class="icon-bar"></span>
            <span class="icon-bar"></span> -->
          </a>
          <a class="brand" href="#">BrEAST website</a>
          <div class="nav-collapse collapse">
              
              <?php
                
                $this->widget('zii.widgets.CMenu', array(
                        'items'=>array(
                array('label'=>'Home', 'url'=>Yii::app()->createUrl("")),
                array('label'=>'BrEAST', 'url'=>array('/site/BrEAST')),
                array('label'=>'Team', 'url'=>array('/site/team')),
                array('label'=>'Clinical trials', 'url'=>array('/site/trials')),
                // array('label'=>'Jobs','url'=>array('/site/jobs')),		
                // array('label'=>'Links', 'url'=>array('/site/links')),
                // array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'BrEAST tools', 'url'=>array('/authenticated/index'), "visible"=> !Yii::app()->user->isGuest)
                ),"htmlOptions"=>array("class"=>"nav")));
                
                ?>
              
              <?php if(Yii::app()->user->isGuest):?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle"data-toggle="dropdown"  href="#">Login<b class="caret"></b></a>                  
                            <ul class="dropdown-menu">
                                <li> <a href="#myLoginForm" role="button" data-toggle="modal">Authenticate</a></li>
                                <li> <a href="#">Sign up</a></li>
                                <li> <a href="<?php echo Yii::app()->createUrl('/site/resetpassword');?>">Reset password</a></li>
                            </ul>
                        </li>
                    </ul>
              
              <?php else:?>
                    <?php if (in_array(Yii::app()->user->profile, array("IT"))):?>
                            <ul class="nav pull-right">
                                <li class="dropdown">
                                    <a class="dropdown-toggle"data-toggle="dropdown"  href="#">Admin<b class="caret"></b></a>                  
                                    <ul class="dropdown-menu">
                                        <li> <a href="<?php echo Yii::app()->createUrl('/administration/biotracking');?>">Biotracking</a></li>
                                        <li> <a href="<?php echo Yii::app()->createUrl('/administration/breast');?>">BrEAST</a></li>
                                        <li> <a href="<?php echo Yii::app()->createUrl('shipment/translational/');?>">Shipment</a></li>
                                    </ul>
                                </li>
                            </ul>
                    <?php endif;?>
              
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle"data-toggle="dropdown"  href="#">Shortcuts<b class="caret"></b></a>                  
                            <ul class="dropdown-menu">
                                <li> <a href="<?php echo Yii::app()->createUrl('biotracking/main/');?>">Biotracking</a></li>
                                <li> <a href="<?php echo Yii::app()->createUrl('reports/');?>">Reporting tools</a></li>
                                <li class="divider"> </li>
                                <li> <a style="font-weight:bold;" href="<?php echo Yii::app()->createUrl('/site/logout');?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    
              <?php endif;?>
             
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <!-- contenu principal -->

        <div id="main_content" style="min-height:700px;">

        <?php echo $content; ?>

        </div>

        <hr/>

        <div class="container">
            <div class="row-fluid">
                <!-- Footer -->
                <p style="text-align:center">@BrEAST <?php echo date('Y'); ?> - All Rights Reserved - <a href="<?php echo Yii::app()->createUrl("site/disclaimer");?>">Legal disclaimer</a></p>
            </div>
        </div>

</body>


<!-- Modal -->
<div id="myLoginForm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <a type="a" class="close" data-dismiss="modal" aria-hidden="true">×</a>
        <h3 id="myModalLabel">Login information</h3>
    </div>

    <form class="form-horizontal" id="login-form" action="/breast_reborn/site/checkLogin" method="post">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label required" for="LoginForm_username">Username</label>
                <div class="controls">
                    <input class="sizeInput" name="LoginForm[username]" id="LoginForm_username" type="text" />
                </div> 
            </div>
            <div class="control-group">
                <label class="control-label required" for="LoginForm_password">Password</label>
                <div class="controls">
                    <input class="sizeInput" name="LoginForm[password]" id="LoginForm_password" type="password" />
                    <span class="help-block">the password is case <b>sen</b>sitive</span>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
            <input class="btn btn-primary" type="submit" name="yt0" value="login"/>                
        </div>
    </form> 
</div>

</html>


