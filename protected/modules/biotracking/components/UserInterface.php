<?php

class UserInterface
{
    public static function getInterfaceItems($profile)
    {
        $profile=  strtolower($profile);
        if (strpos($profile,"investigator"))
            return UserInterface::PiItems ();
    }
    
    private static function PiItems()
    {
        $items=array("New Sample"=>
                                array(
                                    array("a"=>"Register sample","href"=>"/biotracking/biosample/newsample","class"=>"#"),
                                    array("a"=>"Register PK sample","href"=>"#","class"=>"PKMATERIAL"),
                                    array("a"=>"Update sample","href"=>"#","class"=>"AUPDATEDELETEMATERIAL")
                                ),
                                "View Sample"=>
                                array(
                                    array("a"=>"List of registered samples","href"=>"/biotracking/main/mySamples","class"=>"#"),
                                    array("a"=>"Sample PDF forms","href"=>"/biotracking/main/sampleCompletedForm","class"=>"COMPLETEDFORMS"),
                                ),
                                "Request for Shipment"=>
                                array(
                                    array("a"=>"Sample shipment","href"=>"#","class"=>"nothingToDo"),
                                    array("a"=>"Sample return","href"=>"#","class"=>"TISSUERECEPTION"),
                                ),
                                "Data error report form"=>
                                array(
                                    array("a"=>"Data error report form","href"=>"#","class"=>"nothingToDo"),
                                ),
                                "Help"=>
                                array(
                                    array("a"=>"Faqs","href"=>"/biotracking/main/faq","class"=>"nothingToDo"),
                                    array("a"=>"Biotracking manual","href"=>"#","class"=>"nothingToDo"),
                                    array("a"=>"Her2 form","href"=>"#","class"=>"nothingToDo"),
                                    array("a"=>"UICC TNM","href"=>"#","class"=>"nothingToDo"),
                                    array("a"=>"Biotracking security","href"=>"#","class"=>"nothingToDo"),
                                    array("a"=>"Data Error Report Form(pdf version)","href"=>"#","class"=>"nothingToDo")
                                ),
                                "Contact us"=>
                                array(
                                    array("a"=>"How To contact us","href"=>"/biotracking/main/contactus","class"=>"nothingToDo"),
                                ),
                        );
        return $items;
    }
}
