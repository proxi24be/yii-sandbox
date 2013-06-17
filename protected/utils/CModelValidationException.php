<?php
/**
 * User: trann
 * Date: 16/01/13
 * Time: 12:15
 */


/**
 *      Classe qui permet de gérer les erreurs de validation générées par la class CModel de Yii
 *
 *      Par défaut Yii stocke toutes les erreurs de validation dans un tableau
 *      ores si ce tableau est vide en toute vraissemblance l'erreur ne se situe pas au niveau des champs validés
 */
class CModelValidationException extends Exception
{
    public function __construct(array $validationErrors, $currentObject=null)
    {
        $class=get_class($currentObject);
        $this->message=$this->displayContent($validationErrors) . "\nException raising on [$class]" ;
    }

    private function displayContent(array $toDisplay)
    {
        $content="";
        ob_start();
        print_r($toDisplay);
        $content=ob_get_contents();
        ob_end_clean();
        return $content;
    }
}