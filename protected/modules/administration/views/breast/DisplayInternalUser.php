<?php

$baseUrl = Yii::app()->baseUrl ;

$keys= array_keys($users);

foreach ($keys as $key)
{
    if ('clin'==$key)
        $th=array("FIRST_NAME","LAST_NAME","ORACLE_ACCOUNT_NAME","STUDY","CREATION_DATE");
    
    else
        $th=array("USERNAME","CREATED");
    
    $rows=$users[$key];
    
    echo "<p>Database ".  strtoupper($key)."</p>";
    echo "<table class='userAccessTable'>";
    $theader="";
    foreach ($th as $header)
        $theader=$theader. "<th>$header</th>";
    
    echo "<thead><tr>$theader</tr></thead>";
    echo "<tbody>";
    $compteur = count($rows[$th[0]]);
    for ($i=0;$i<$compteur;$i++)
    {
        $td="";
        foreach ($th as $header)
            $td=$td."<td>".$rows[$header][$i]."</td>";
        
        echo utf8_encode("<tr>$td</tr>"); // ce n'est peut-être pas super optimisé d'encoder les caractères spéciaux...
    }
    echo "</tbody>";    
    echo "</table>";
}

?>


<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_table_jui.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_page.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_table.css" rel="Stylesheet" />
<script type="text/javascript" src="<?php echo $baseUrl; ?>/javascript/DataTables-1.8.1/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(".userAccessTable").dataTable(
{
    "bJQueryUI" : true,
       "sPaginationType": "full_numbers",
       "aaSorting": [] //no initial sorting
});

</script>