<?php

class HtmlTable extends CWidget {
    
    public $id='htmlTableWidgetID';
    public $class='htmlTableWidgetClass';
    public $th;
    // array activerecords
    public $data;
    public $extraTD = array();
    // correspond au nom des champs dans la table
    public $td= array();    

     // this method is called by CController::beginWidget()
    // public function init ()
    // {
        
    // }


     // this method is called by CController::endWidget()
    public function run ()
    {
        $this->render("HtmlTableView");
    }

}
