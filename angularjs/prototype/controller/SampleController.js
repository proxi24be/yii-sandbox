/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/11/13
 * Time: 12:43 PM
 */


SetupPrototype.controller('SampleController',
    function($scope, $http, GenericModel, StudyVisitModel, VisitSampleModel){

        $scope.readSample = function ()
        {
            GenericModel.read($http, 'AdmSample')
                .then(function(response){
                    $scope.db.samples = response.data;
                });
        };

        $scope.readStudy = function ()
        {
            GenericModel.read($http, 'AdmStudy')
                .then(function(response){
                    $scope.db.studies = response.data;
                });
        };

        $scope.readAttachedVisit = function ()
        {
            if (typeof $scope.dataToCollect.study != 'undefined')
            {
                StudyVisitModel.readAttachedVisit($http, $scope.dataToCollect.study)
                    .then(function(response){
                        $scope.db.attachedVisits = response.data;
                    });
            }
        };

        $scope.createSample = function ()
        {
            try
            {
                httpParam.setModel('AdmSample');
                httpParam.pushData({DESCRIPTION : $scope.dataToCollect.newSample.SAMPLE_TYPE});
                GenericModel.create($http, httpParam.flushParams())
                    .then(function(response) {
                        if (response.data.request == 'success')
                        {
                            $scope.readSample();
                            $scope.dataToCollect.newSample.SAMPLE_TYPE ='';
                        }
                    });
            }
            catch (e)
            {
                console.log(e);
            }
        };

        $scope.attach = function ()
        {
            try
            {
                if (typeof $scope.dataToCollect.study != 'undefined'
                    && typeof $scope.dataToCollect.visits != 'undefined'
                    && typeof $scope.dataToCollect.samples != 'undefined')
                {

                    httpParam.setModel('AdmVisitSample');
                    var visits = $scope.dataToCollect.visits;
                    var samples = $scope.dataToCollect.samples;
                    var studyID = $scope.dataToCollect.study.ID;
                    var v,s;
                    for (s in samples)
                    {
                        for (v in visits)
                            httpParam.pushData({VISIT_ID : visits[v].ID, SAMPLE_ID : samples[s].ID, STUDY_ID : studyID});
                    }
                    GenericModel.create($http, httpParam.flushParams())
                        .then(function(response){
                            if (response.data.request == 'success')
                                console.log('operation completed');
                            else
                                console.log('An issue has occured');
                        });
                }
            }
            catch (e)
            {
                console.log(e);
            }
        };

        $scope.readAttachedSample = function ()
        {
            try
            {
                VisitSampleModel.readAttachedSample($http, $scope.dataToCollect.study)
                    .then(function (response){
                        $scope.db.attachedSamples = response.data;
                    });
            }
            catch (e)
            {

            }
        };

        // Start init.
        $scope.db = {};
        $scope.dataToCollect = {};
        $scope.readSample();
        $scope.readStudy();
        httpParam.resetParams();
        // End init.
    });