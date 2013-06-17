NewSample.controller('SampleDetailsController',

    function ($scope, $http, SampleFormModel) {

        // object gets from NewSampleController
        $scope.dataToCollect = myConfig.dataToCollect;
        // fetch all the attributes
        $scope.allAttributes = SampleFormModel.getAllAttributes($scope.dataToCollect);

        SampleDetailsForm.$scope = $scope;

//        SampleDetailsForm.setNgModelWithValueInDB();

        sampleDetailsJquery.initJqueryUIWidget();

        $scope.saveForm = function () {
            if (0 === sampleDetailsJquery.validateInput())
            {
                // Little workaround for jquery-ui calendar
                $scope.dataToCollect.collection_date ={ 'COLLECTION_DATE' : $('#collection_date_id').val()};
                var status = SampleFormModel.save($http, $scope.dataToCollect);

            }
        }
    }
);

var SampleDetailsForm =
{
    // reference to AngularJS.$scope
    $scope: null,

    setNgModelWithValueInDB: function () {
        var allAttributes = SampleDetailsForm.$scope.allAttributes;
        for (name in allAttributes.valuesInDB) {
            // An value has been saved by the end-user previously
            if (typeof allAttributes.valuesInDB[name].value != 'undefined')
            // Two differents scenario can occur
            {
                if (typeof allAttributes.valuesInDB[name].inArray != 'undefined')
                // The model to search is in an array
                {
                    var modelFound = SampleDetailsForm.getModel(allAttributes.valuesInDB[name].value, allAttributes[name]);
                    if ('undefined' != modelFound)
                        SampleDetailsForm.$scope.dataToCollect[allAttributes.valuesInDB[name].ngModel] = modelFound;
                }
                else
                // Simply assign the value of the DB to the model
                {
                    SampleDetailsForm.$scope.dataToCollect[allAttributes.valuesInDB[name].ngModel] = allAttributes.valuesInDB[name].value;
                }
            }
        }
    },

    getModel: function (searchValue, arrayToSearch) {
        var modelFound = "undefined";
        for (indice in arrayToSearch) {
            if (searchValue == arrayToSearch[indice].TEXT)
                modelFound = arrayToSearch[indice]
        }

        return modelFound;
    }

}

var sampleDetailsJquery =
{
    initJqueryUIWidget: function () {
        $("#collection_date_id").datepicker({

            showOn: "button",
            buttonImage: myConfig.baseUrl + "/images/icons/cal.gif",
            buttonImageOnly: true,
            dateFormat: "dd/M/yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+0"

        });
    },

    validateInput: function () {
        var elementForm = $("form#sampleDetailsForm").find("select:visible, input:visible");
        elementForm.each(function() {
            if ('state' != $(this).attr('name'))
            {
                // specific to angularjs see ng-model
                if ($(this).val() == '?' || $(this).val() == '')
                    $(this).parent().prev().addClass("ui-state-error-text")
                        .effect("bounce", { times: 3 }, 300);
                else
                    $(this).parent().prev().removeClass("ui-state-error-text");
            }
        });

        return $(".ui-state-error-text:visible").size();
    }
};