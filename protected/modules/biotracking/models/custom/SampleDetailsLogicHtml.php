<?php
/**
 * User: TRANN
 * Date: 3/13/13
 * Time: 12:59 PM
 */

/**
 * Class SampleDetailsLogicHtml
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
class SampleDetailsLogicHtml
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
            "pathological" => array(
                "label" => "Local pathological ID",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.LOCAL_ID",
                        "name" => "local_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "pathological",
                )
            ),

            "cryovials" => array(
                "label" => "Number of cryovials",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.CRYOVIALS_NUMBER",
                        "name" => "cryovials_number_id",
                        "class" => "input-mini",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "ng-model" => "dataToCollect.cryovials",
                ),
            ),

            "temperature" => array(
                "label" => "Storage temperature",
                "elementForm" => array(
                    "tag" => "radio",
                    "options" => array(
                        "ng-model" => "dataToCollect.TEMPERATURE",
                        "name" => "temperature",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "temperature",
                )
            ),

            "collectionDate" => array(
                "label" => "Collection date",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.COLLECTION_DATE",
                        "name" => "collection_date_id",
                        "readonly" => "readonly"
                    )
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "collectionDate",
                )
            ),

            "fixative" => array(
                "label" => "Fixative",
                "elementForm" => array(
                    "tag" => "select",
                    "options" => array(
                        "ng-model" => "dataToCollect.fixative",
                        "ng-options" => "fixative.FIXATIVES for fixative in allAttributes.fixatives",
                        "name" => "fixatives_id",
                    )
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "fixative",
                )
            ),

            "otherFixative" => array(
                "label" => "If other, please specify",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "ng-model" => "dataToCollect.OTHER_FIXATIVES",
                        "name" => "other_fixatives_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "otherFixative",
                ),
            ),

            "sampleState" => array(
                "label" => "Sample state",
                "elementForm" => array(
                    "tag" => "select",
                    "options" => array(
                        "ng-model" => "dataToCollect.sampleState",
                        "ng-options" => "sampleState.TEXT for sampleState in allAttributes.sampleStates",
                        "name" => "material_state_id",
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "sampleState",
                ),
            ),
            "comment" => array(
                "label" => "Comment",
                "elementForm" => array(
                    "tag" => "textarea",
                    "options" => array(
                        "ng-model" => "dataToCollect.COMMENT",
                        "name" => "comment_id",
                        "style" => "width:380px; height:150px;"
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "comment",
                ),
            ),
            "street" => array(
                "label" => "Street",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "name" => "street",
                        'ng-model' => 'dataToCollect.address.ADDRESS_STREET',
                        'class' => 'input-xlarge',
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "street",
                ),
            ),
            "city" => array(
                "label" => "City",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "name" => "city",
                        'ng-model' => 'dataToCollect.address.ADDRESS_CITY',
                        'class' => 'input-large',
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "city",
                ),
            ),
            "state" => array(
                "label" => "State",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "name" => "state",
                        'ng-model' => 'dataToCollect.address.ADDRESS_STATE',
                        'class' => 'input-medium',
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "state",
                ),
            ),
            "postcode" => array(
                "label" => "Postcode",
                "elementForm" => array(
                    "tag" => "input",
                    "options" => array(
                        "name" => "postcode",
                        'ng-model' => 'dataToCollect.address.ADDRESS_POSTCODE',
                        'class' => 'input-small',
                        'value' => '{{ dataToCollect.allAttributes.returnAddress.ADDRESS_POSTCODE }}',
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "postcode",
                ),
            ),
            "country" => array(
                "label" => "Country",
                "elementForm" => array(
                    "tag" => "select",
                    "options" => array(
                        "name" => "country_id",
                        "ng-options" => "country.COUNTRY for country in allAttributes.countries | orderBy:COUNTRY",
                        'ng-model' => 'dataToCollect.address'
                    ),
                ),
                "divCtrlGroupOptions" => array(
                    "class" => "country",
                ),
            ),

        );
    }

}

