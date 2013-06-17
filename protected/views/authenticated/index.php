<?php 

$this->breadcrumbs=array(
	'Study tools',
);

?>

<script language="JavaScript">
    var _windowHandle = null;
    var _windowStyle = 'menubar=0, toolbar=0,location=0,directories=0,status=0,menubar=0, scrollbars=1,resizable=1,copyhistory=0';
    var _windowName = 'RDCOnsite';
    function launchOnsite(url) {
//        alert ("Dear User,\n\nThe eCRF system is in a maintenance mode therefore the system is temporary inaccessible.\n\nPlease accept our apologies for this inconvenience.");
        var urlToOpen;
        if (url.indexOf('?') < 0) {
             urlToOpen = url + '?r=' + Math.random();    //This will ensure that page is current, not from browser cache
        } else {
             urlToOpen = url + '&r=' + Math.random();
        }
        try {
//            if (_windowHandle && _windowHandle.open) {
//                _windowHandle.focus();
//            } else {
//                 _windowHandle = window.open(urlToOpen, _windowName, _windowStyle);
//            }
                window.open(urlToOpen, _windowName, _windowStyle);
        } catch (e) {
             _windowHandle = window.open(urlToOpen, _windowName, _windowStyle);
        }
   }
</script>

<style>
    
    div.breasttools ul
    {
        list-style: none;
    }
    
    div.breasttools li
    {
        height:250px;
        margin: 0 1em 1em 0;
        padding:20px;
        text-align: justify;
        border-style:solid;
        border-width: medium;
    }
    
    div.breasttools li a
    {
        display:block;
        padding:5px;
        text-decoration: none;
    }
    
    div.breasttools p.tipReset
    {
        background-color: #F3F3F3;
        border-color: #D4D4D4;
        text-align: justify;
        font-size:0.8em;
        padding:10px;
        width:325px;
        margin-bottom: 20px;
    }
    
    h3.title
    {
        margin-left:25px;
    }
    
    div.breasttools a
    {
        color:black
    }
    
    div.breasttools a:hover
    {
        color:orange;
        font-weight: bold;
    }
    
    div.breasttools li.alert a
    {
        color:white;
    }
    
</style>

<div class="breasttools container">
    <div class="row">
            <h3 class="title">BrEAST Study Tools</h3>
            <p class="tipReset span12" ><span class="ui-icon ui-icon-info" style="float:left"></span><span style="margin-left:20px; display:block">Please click on the item that you want to use</span> </p>

            <ul class="span12">
                <?php foreach ($roleApp as $app){ ?>

                <?php if ($app['APP_NAME'] == 'BIOTRACKING') {?>
                <li class="span4" style="background:#f2fafc;border-color:#dee6e8;">
                        <a href="<?php echo Yii::app()->baseUrl;?>/biotracking/main"><b>Biotracking System</b> <br/><br/>
                        Web-based system developed to record and track biological samples collected within a clinical trial.
                        </a>
                </li>
                <?php }?>

                <?php if ($app['APP_NAME'] == 'ELEARNING') {
                    $path = Yii::app()->createUrl("authenticated/elearning");
                ?>

                <li class="span4" style="background:#FAFEF3;border-color:  #e0dfe1;">
                    <a href="<?php echo $path; ?>"><b>eLearning: eCRF</b><br/><br/>
                    The eCRF training will consist of online role-specific training modules, i.e. Investigator, Study Coordinator or Monitor. <br/>
                    </a>
                    <p><span class="ui-icon ui-icon-info" style="float:left"></span>If training is not completed access to the eCRF will not be granted.</p>
                </li>
                <?php }?>

                <?php if ($app['APP_NAME'] == 'RDC') {?>
                <li class="span4" style="background:#F0F2F7;border-color: #DCDEE3;">
                    <a href="javascript:launchOnsite('https://www.br-e-a-s-t.org/olsa/oc/rdcLogin.do?event=doSetup&db=clin')"><b>eCRF • Oracle Clinical version 4.6</b><br/><br/>
                        A computerized system designed for the collection of clinical data in electronic format.<br/>
                    </a>

                    <p><span class="ui-icon ui-icon-info" style="float:left"></span>The eCRF system works only with <b>Internet explorer 7</b> so if you are using a newer version of Internet explorer please activate the <b>compatibility view</b>.</p>
                    <p><span class="ui-icon ui-icon-info" style="float:left"></span>See here a list of common problem and how to resolve it <a style="color:blue;text-decoration:underline;display:inline;padding:0;" href="#">download</a></p>
                </li>
                <?php } ?>

                <?php if ($app['APP_NAME'] == 'REPORTING') {?>
                <li class="span4" style="background:#FDFBF5;border-color:#E2DFE3;">
                    <a href="<?php echo Yii::app()->createUrl('reports/')?>"><b>Reporting tools</b> <br/><br/>
                        A study tool that gives up to date, site specific information that will help to better follow patients and monitor the site’s activity.
                    </a></li>
                <?php } ?>

                <?php if ($app['APP_NAME'] == 'SHIPMENT') {?>
                <li class="span4" style="background:#fbf7fe;border-color:#e7e3ea;"><a href="<?php echo Yii::app()->createUrl('shipment/translational/')?>"><b>BrEAST shipment tools</b></a></li>
                <?php } ?>

                <?php if ($app['APP_NAME'] == 'ADMINISTRATION') {?>
                <li class="span4 alert alert_blue"><a href="<?php echo Yii::app()->createUrl('administration')?>">ADMINISTRATION TOOLS <br/><br/>
                    For internal use.
                    </a></li>
                <?php } ?>

                <?php }// end foreach  ?>
            </ul>
    </div>
    
</div>