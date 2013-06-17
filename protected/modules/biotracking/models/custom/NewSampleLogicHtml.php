<?php
/**
 * User: TRANN
 * Date: 3/13/13
 * Time: 12:59 PM
 */

/**
 * Class NewSampleLogicHtml
 *
 * Keys explanation:
 *
 *  label
 *      Label text to display.
 *  elementForm
 *      The attributes will be added to input|select|radio element.
 *  divCtrlGroupOptions
 *      The attributes will be added to <div class='control-group'> element.
 *  tag
 *      Define to the the widget FormControlGroup which type of element
 *      needs to be created : select , input ,radio.
 *  help
 *      The text-help to display by default it will be placed
 *      just below the form control element.
 */
class NewSampleLogicHtml
{
    /**
     * @return array
     *      The array will contain all the common attributes to all study.
     *      To get all the attributes specific to a study, use the factory
     *      method instead.
     */
    public static function allStudy()
    {
        return array(
            "patient" => array(
                "label" => "Patient number",
                "elementForm" => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.patient",
                        "ng-options" => "patient.SCREENING_NUMBER for patient in patients",
                        "ng-change " => "getVisit()",
                        "name"       => "patient_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "patient",
                )
            ),

            "birthdate" => array(
                "label" => "Birthdate",
                "elementForm" => array(
                    "tag"     => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.patient.ddmmmyyyy",
                        "readonly" => "readonly",
                        "name"  => "birth_date_id",
                        "value" => "{{dataToCollect.patient.BIRTHDATE | convertToDDMMMYYYY}}",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "ng-show" => "dataToCollect.patient.PATIENT_ID"
                ),
                "help" => "For data protection reasons the date of birth will not appear on any report, nevertheless,
                            it is strongly encouraged to report it for quality control reasons"
            ),

            "visit" => array(
                "label" => "Visit name",
                "elementForm" => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.visit",
                        "ng-options" => "visit.VISIT_NAME for visit in visits | orderBy:visit.VISIT_INTERVAL",
                        "ng-change"  => "getSampleType(); resetConditionalDropDownBox();",
                        "name"       => "visit_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "ng-show" => "dataToCollect.patient.PATIENT_ID",
                    "class"   => "visit",
                ),
            ),

            "sampleType" => array(
                "label" => "Sample type",
                "elementForm"  => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.sampleType",
                        "ng-options" => "sampleType.DESCRIPTION for sampleType in sampleTypes",
                        "ng-change"  => "computeSampleNumber()",
                        "name" => "material_type_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class"  => "sampleType",
                    "ng-show"=> "dataToCollect.visit.VISIT_ID",
                )
            ),

            "laterality" => array(
                "label" => "Laterality",
                "elementForm" => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.laterality",
                        "ng-options" => "laterality.LATERALITY for laterality in lateralities",
                        "name"       => "laterality_id",
                    )
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "laterality",
                )
            ),

            "conditioning" => array(
                "label" => "Conditioning",
                "elementForm" => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.conditioning",
                        "ng-options" => "conditioning.CONDITIONING for conditioning in conditionings",
                        "name"       => "conditioning_id",
                    )
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "conditioning",
                )
            ),

            "bloodTechnical" => array(
                "label" => "Use for",
                "elementForm" => array(
                    "tag"     => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.bloodTechnical",
                        "ng-options" => "bloodTechnical.BLOOD_TECHNICAL for bloodTechnical in bloodTechnicals",
                        "ng-change"  => "computeSampleNumberBloodTechnicals()",
                        "name"       => "blood_technical_id",
                    ),
                ),
                "divCtrlGroupOptions"=>array(
                    "class" => "bloodTechnical",
                ),
            ),

            "endTaxanes" => array(
                "label" => "Applicable cycle/week",
                "elementForm"  => array(
                    "tag"  => "select",
                    "options" => array(
                        "ng-model"   => "dataToCollect.endTaxane",
                        "ng-options" => "endTaxane.END_TAXANES for endTaxane in endTaxanes",
                        "ng-change"  => "computeSampleNumberEndTaxanes()",
                        "name"       => "end_taxanes_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class"   => "endTaxanes",
                    "ng-show" => "dataToCollect.visit.VISIT_NAME
                                 && ('taxanes treatment completion'== dataToCollect.visit.VISIT_NAME.toLowerCase())"
                ),
                "help" => "As this sample could be collected at the beginning of cycle 4 (week 10) or cycle 5 (week 13)
                        if an Anthracycline was given previously or at cycle 7 (week 19) if Taxane was given alone,
                        please choose carefully from the drop-down list the applicable cycle/week when this sample was collected."
            ),
        );
    }

    /**
     * @return array
     *      The array will contain only attributes specific to aphinity study.
     *      To get all attributes use the factory method instead
     */
    public static function aphinityStudy()
    {
        return array(
            "sampleNumber" => array(
                "label" => "Sample number",
                "elementForm" => array(
                    "tag"     => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.SAMPLE_NUMBER",
                        "readonly" => "readonly",
                        "class"    => "ui-corner-all input-mini",
                        "name"     => "sample_number_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class"   => "sampleNumber",
                    "ng-show" => "dataToCollect.visit.VISIT_NAME
                                && dataToCollect.sampleType.DESCRIPTION",
                ),
            ),
            "kitNumber" => array(
                "label" => "Sample kit number",
                "elementForm" => array(
                    "tag"     => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.KIT_NUMBER_ID",
                        "class"    => "ui-corner-all",
                        "name"     => "kit_number_id",
                        'type'     => 'text',
                    )
                ),
                "divCtrlGroupOptions" => array(
                    "class"   => "kitNumber",
                    "ng-show" => "dataToCollect.visit.VISIT_ID
                                 && dataToCollect.visit.VISIT_NAME != 'SCREENING'",
                ),
            ),
        );
    }

    /**
     * @param $studyName
     * @return array
     *      The array returned contain all the attributes for the study.
     *      This include the shared attributes and the specific attributes to the study.
     */
    public static function factory($studyName)
    {
        if ("aphinity" == strtolower($studyName))
            return CMap::mergeArray(NewSampleLogicHtml::allStudy(),
                NewSampleLogicHtml::aphinityStudy());
        else
            return array();

    }

}

