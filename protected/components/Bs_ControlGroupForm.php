<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TRANN
 * Date: 3/15/13
 * Time: 12:01 AM
 * 
 */


class Bs_ControlGroupForm extends CWidget
{
    public $properties;
    private $_label;
    private $_htmlOptions;

    public function init()
    {
        if (array_key_exists("label", $this->properties))
            $this->_label = $this->properties["label"];

        if (array_key_exists("divCtrlGroupOptions", $this->properties))
            $this->_htmlOptions = $this->properties["divCtrlGroupOptions"];

        if (array_key_exists("class", $this->_htmlOptions))
            $this->_htmlOptions["class"]="control-group " . $this->_htmlOptions["class"];
        else
            $this->_htmlOptions["class"]="control-group";

        echo CHtml::tag("div", $this->_htmlOptions, false, false) . "\n";
        echo "<label class='control-label'>$this->_label</label>\n";
        echo "<div class='controls'>\n";
    }

    public function run()
    {
        echo "</div>\n</div>\n";
    }


}