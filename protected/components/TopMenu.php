<?php

class TopMenu extends CWidget {
    // array activerecords
    public $applications;

    // this method is called by CController::beginWidget()
    // public function init ()
    // {
        
    // }


     // this method is called by CController::endWidget()
    public function run ()
    {
        $this->render("HtmlTopMenuView");
    }

}

