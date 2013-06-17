var NewSample = angular.module('NewSample',[]);

var NewSampleConfig = function($routeProvider){
    $routeProvider
        .when("/",{
            controller : 'NewSampleController',
            templateUrl : myConfig.angularUrl+'/biotracking/biosample/newSample?form=newsampleform'
        })
        .when ("/sampleDetailsForm",{
        controller : 'SampleDetailsController',
        templateUrl : myConfig.angularUrl+'/biotracking/biosample/newSample?form=sampledetailsform'
    });
};

NewSample.config(NewSampleConfig);

NewSample.filter('convertToDDMMMYYYY', function() {
    return function (dateDDMMYYYY) {
        if (dateDDMMYYYY != undefined)
        {
            var month = new Array();
            month[0] = "Jan";
            month[1] = "Feb";
            month[2] = "Mar";
            month[3] = "Apr";
            month[4] = "May";
            month[5] = "Jun";
            month[6] = "Jul";
            month[7] = "Aug";
            month[8] = "Sep";
            month[9] = "Oct";
            month[10] = "Nov";
            month[11] = "Dec";
            var d = dateDDMMYYYY.split("-");

            return d[0] + "/" + month[d[1]-1] + "/" + d[2];
        }
    };
});
