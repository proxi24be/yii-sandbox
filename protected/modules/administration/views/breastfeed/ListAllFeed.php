<style>
    
    div.feed
    {
        margin-top:25px;
        margin-bottom: 25px;
    }
    
</style>

<?php

if (count($model)>0)
{
    foreach ($model as $row)
    {
        echo "<div class='feed'>";
        echo "<div class='grid_8'>$row->HTMLTEXT</div>";
        echo "<div class='clear'></div>";
        echo "</div>";
        echo "<hr/>";
    }
}

?>
