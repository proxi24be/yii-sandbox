<?php
$baseUrl =  Yii::app()->request->baseUrl;
$this->breadcrumbs=array(
	'jobs',
);

?>

<style>
    
    div.jobs li a
    {
        text-decoration: none;
        color:black;
    }
    
    div.jobs li a:hover
    {
        text-decoration: underline;
        color:blue;
    }
    
</style>

<div class="jobs container">
    <div class="row-fluid">
        <div class="span9">
    
        <h3 class="title">Jobs</h3>
            <p>The BrEAST Data Center is seeking for :</p>

            <ul class="jobApplicable">
                <li><a href="http://www.bordet.be/fr/emploi/oncologie/breast_pro.html">Clinical Data Programmer</a></li>
                <li><a href="http://www.bordet.be/en/job/onco/breast_info.html">IT Specialist</a></li>
            </ul>

        </div>

        <div class="span3">

            <img src="<?php echo $baseUrl;?>/images/bordet4.jpg"/>
            <p>Jules Bordet Institute</p>

        </div>


        <div class="span9">
            Feel free to send anyway your curriculum vitae to <a href="mailto:marielle.sautois@bordet.be"><u>marielle.sautois@bordet.be</u></a> 
                or go to the <a href="http://www.bordet.be/en/job/job.htm" target="_blank"><u>Jules Bordet Institute jobs' page</u></a>.
        </div>
        
    </div>
    
</div>
