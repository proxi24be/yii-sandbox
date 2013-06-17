NewSample.controller('NewSampleController',

    function ($scope, $location, PatientModel, GenericStudyModel, VisitModel, SampleTypeModel, AphinityModel, NewSampleValidationModel) {

        $scope.studyName = myConfig.currentStudy;
        $scope.patients = PatientModel.getListOfPatient();
        $scope.conditionings = GenericStudyModel.getConditioning();
        $scope.lateralities = GenericStudyModel.getLaterality();

        //  define study specific business
        if ('aphinity' == $scope.studyName.toLowerCase()) {
            myConfig.extendScope($scope, new AphinityScope($scope));
            $scope.setModel(AphinityModel);
        }
        newSampleJquery.initJqueryUIWidget();

        $scope.getVisit = function () {
            $scope.visits = VisitModel.getListOfVisit($scope.dataToCollect.patient.PATIENT_ID);
        }

        $scope.getSampleType = function () {
            $scope.sampleTypes = SampleTypeModel.getListOfSampleType($scope.dataToCollect.patient.PATIENT_ID, $scope.dataToCollect.visit.VISIT_ID);
        }

        $scope.submitInfo = function () {
            if (0 === newSampleJquery.validateInput()) {
                // little workaround: Angularjs was not able to update the model of birthdate_dd_mmm_yyyy maybe because it is a jquery-ui widget...
                $scope.dataToCollect.patient.ddmmmyyyy =  $("#birth_date_id").val();

                var status = NewSampleValidationModel.getValidationStatus($scope.dataToCollect);
                if ("success" == status) {
                    myConfig.dataToCollect = $scope.dataToCollect;
                    $location.path("/sampleDetailsForm").replace();
                }
                else
                    console.log("An issue has occured during the validation of your information");
            }
        }

        $scope.resetConditionalDropDownBox = function () {
            $scope.conditionings = GenericStudyModel.getConditioning();
            $scope.lateralities = GenericStudyModel.getLaterality();

            if ('aphinity' == $scope.studyName.toLowerCase())
                $scope.setModel(AphinityModel);
        }

    }
);

var newSampleJquery =
{
    initJqueryUIWidget: function () {
        $("#birth_date_id").datepicker({

            showOn: "button",
            buttonImage: myConfig.baseUrl + "/images/icons/cal.gif",
            buttonImageOnly: true,
            dateFormat: "dd/M/yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "-90:+0"

        });

        $("#dialog:ui-dialog").dialog("destroy");

        $("div.myDialog").dialog({
            resizable: false,
            height: 250,
            width: 350,
            modal: true,
            autoOpen: false
        });
    },

    validateInput: function () {
        var elementForm = $("form#newSample").find("select:visible, input:visible");
        elementForm.each(function () {
            // Customize it as your need.
            if ($(this).attr("name") !== 'birth_date_id') {
                // specific to angularjs see ng-model
                if ($(this).val() == '?' || $(this).val() == '')
                    $(this).parent().prev().addClass("ui-state-error-text")
                        .effect("bounce", { times: 3 }, 300);
                else
                    $(this).parent().prev().removeClass("ui-state-error-text");
            }
        });

        return $(".ui-state-error-text:visible").size();
    },

    callNextMenu: function ($location) {
        // the next form that will be called is sample type specific
        $("form#newSample").toggle("slide", "slow");
    }
};