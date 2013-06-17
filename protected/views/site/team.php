<?php
$baseUrl = Yii::app()->baseUrl;
$this->breadcrumbs=array(
	'Team',
);
?>

<style>

div.team_right a {
	text-decoration :none;
	color:black;
}

div.team_right a:hover{
	color:blue;
	text-decoration:underline;
}

div.team_left li
{
    float:left;
    width:200px;
    height:80px;
    list-style: none;
    border-style:solid;
    border-width: medium;
    background: #f4f7fe;
    border-color:#e0e3ea;
    padding:10px;
    margin-left:10px;
    margin-top:15px;
    font-size:0.9em;
}

div.team_left span.fullname, div.team_left span.email
{
    display:block;
    margin-bottom: 10px;
}

div.team_left h3.department
{
    margin-left:45px;
}

</style>

<div class="container">
    
    <div class="row-fluid">
        
        <div class="span8 team_left">	
        <?php 
            if ($team == null)
                echo "<img src='$baseUrl/images/team.jpg'/>";
            else
            {
                echo "<h3 class='department'>$department->NAME</h3>";
                echo "<ul>";
                foreach ($team as $member)
                {
                    echo "<li>";
                    $fullname= utf8_encode($member->FIRSTNAME ." ". $member->LASTNAME);
                    echo "<span class='fullname'>$fullname</span>";
                    echo "<span class='email'>$member->EMAIL</span>";
                    if (!empty($member->STUDY))
                            echo "<span>Study : $member->STUDY</span>";
                            
                    echo "</li>";
                }
                echo "</ul>";
            }
        ?>
        </div>

        <div class="span4 team_right" style="text-align:right; font-size:12px;">
            <h3 class="title">Our Team</h3>
                <?php
                        $url=Yii::app()->createUrl("site/team");
                        foreach ($functions as $function)
                        {
                            if ($department != null && $department->ID==$function->ID)
                                echo "<a href='$url?d=$function->ID'> <b>$function->NAME</b></a><br/>";    
                            else
                                echo "<a href='$url?d=$function->ID'> $function->NAME</a><br/>";
                        }
                ?>
        </div>
        
    </div>
    
</div>


