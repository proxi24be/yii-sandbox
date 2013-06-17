<?php


class Tab extends CWidget{
    
    public $id,$class,$tabs;
    
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        $li="";
        foreach($this->tabs as $tab)
        {
            $a=$tab["a"];
            $href=$tab["href"];
            $href=Yii::app()->createAbsoluteUrl($href);
            $li =$li . "<li><a href='$href'>$a</a></li>\n";
        }
        echo "<ul id='$this->id' class='$this->class'>$li</ul>\n";
    }
    
}


?>
