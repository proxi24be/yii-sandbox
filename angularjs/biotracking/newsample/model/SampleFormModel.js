NewSample.service('SampleFormModel', function () {
    // generic behavior

    this.getAllAttributes = function (dataToCollect) {
        var valueToReturn = undefined;

        $.ajax({
            url: myConfig.baseUrl + "/biotracking/sampleForm/getAllAttributesForSampleForm",
            dataType: "json",
            data: dataToCollect,
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    }

    this.save = function ($http, dataToCollect) {
        $http.post(myConfig.baseUrl +'/biotracking/sampleForm/saveSampleForm', dataToCollect)
            .success(function(status){
                    console.log(status);
            });
    }

});
