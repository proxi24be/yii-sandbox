<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TRANN
 * Date: 3/15/13
 * Time: 12:33 AM
 * 
 */

class FactoryFormElement extends CWidget

{
    public $properties;
    private $_value, $_htmlTag, $_help, $_name, $_htmlOptions;

    public function init()
    {
        // Determine which element form to create.
        if (array_key_exists("elementForm", $this->properties))
            $this->_htmlTag = $this->properties["elementForm"]["tag"];

        // Retrieve the html attribute for the element form.
        if (array_key_exists("options", $this->properties["elementForm"]))
            $this->_htmlOptions = $this->properties["elementForm"]["options"];

        if (array_key_exists("value", $this->properties["elementForm"]['options']))
            $this->_value = $this->properties["elementForm"]['options']["value"];

        // Check if any help message needs to be displayed.
        if (array_key_exists("help", $this->properties))
            $this->_help = $this->properties["help"];

        // Retrieve the name attribute of the element form
        if (array_key_exists("name", $this->properties["elementForm"]["options"]))
            $this->_name = $this->properties["elementForm"]['options']["name"];
    }

    public function run()
    {
        if ('input' === strtolower($this->_htmlTag))
            echo CHtml::textField($this->_name, $this->_value, $this->_htmlOptions) . "\n";

        else if ('select' === strtolower($this->_htmlTag))
            echo CHtml::dropDownList($this->_name, "", array(),$this->_htmlOptions) ."\n";

        else if ('radio' === strtolower($this->_htmlTag))
            echo Chtml::radioButtonList($this->_name, "", array(),$this->_htmlOptions) ."\n";

        else if ('textarea' === strtolower($this->_htmlTag))
            echo CHtml::textArea($this->_name,"", $this->_htmlOptions) . "\n";

        else
            throw new Exception ("This html component has not been implemented: $this->_htmlTag");

        if (!empty($this->_help))
            echo CHtml::tag("span",array("class" => "help-block"), "<small>$this->_help</small>");
    }
}