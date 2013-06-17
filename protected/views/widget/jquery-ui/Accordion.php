<?php

class Accordion extends CWidget
{
    public $items;
    
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        // this method is called by CController::endWidget()
        $accordion="";
        $keys=array_keys($this->items);
        foreach ($keys as $key)
        {
            $accordion =$accordion ."<h3><a href='#'>$key</a></h3>\n";
            $items=$this->items[$key];
            $ul="<ul>";
            foreach($items as $item)
            {
                $a=$item["a"];
                $class=$item["class"];
                $href=$item["href"];
                $href=Yii::app()->createAbsoluteUrl($href);
                $ul =$ul . "<li><a href='$href' class='$class'>$a</a></li>\n";
            }
            $accordion =$accordion . "$ul</ul>\n";
        }
        echo $accordion;
    }
}



?>
