<table id ="<?php echo $this->id ;?>" class= "<?php echo $this->class ;?>" >
<thead>
<!-- creation des headers  -->
    <tr>
        <?php 
            foreach ($this->th as $th)
                    echo "<td>$th</td>";
            echo "\n";
        ?>
    </tr> 
</thead>

<!-- creation du contenu des cellules -->
<tbody>
        <?php
            foreach ($this->data as $activeRecord)
            {
                echo "<tr>";
                foreach ($this->td as $td)
                            echo "<td><input type='hidden' name='".$td."[]' value='$activeRecord[$td]'/> $activeRecord[$td]</td>";
                foreach ($this->extraTD as $td)
                            echo "<td>$td</td>";
                                
                echo "</tr>";
                echo "\n";
            }
        ?>
</tbody>
</table>