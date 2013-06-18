/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/17/13
 * Time: 12:14 PM
 */


SetupPrototype.controller('FormController',
    function($scope, $http, GenericModel, StudyVisitModel, VisitSampleModel){

        $scope.formToDo = function ()
        {
            if (typeof $scope.dataToCollect.formToDo != 'undefined')
            {

            }
        };

        $scope.setStudy = function ()
        {
            GenericModel.read($http, 'AdmStudy')
                .then(function(response){
                    $scope.db.studies = response.data;
                });
        }

        $scope.readAttachedVisit = function ()
        {
            if (typeof $scope.dataToCollect.study != 'undefined')
            {
                StudyVisitModel.readAttachedVisit($http, $scope.dataToCollect.study)
                    .then(function(response){
                        $scope.db.visits = response.data;
                    });
            }
        };

        $scope.readAttachedSample = function ()
        {
            if (typeof $scope.dataToCollect.visit != 'undefined')
            {
                VisitSampleModel.readAttachedSample ($http, $scope.dataToCollect.study,
                        $scope.dataToCollect.visit.ID)
                    .then(function(response){
                        $scope.db.samples = response.data;
                    });
            }
        };

        $scope.showAttributeForm = function ()
        {
            if (typeof $scope.dataToCollect.sample != 'undefined')
            {
                GenericModel.read($http, 'AdmGenericValue')
                    .then(function(response){
                        $scope.db.generic_values = response.data;
                    });
                GenericModel.read($http, 'AdmProperty')
                    .then(function(response){
                        $scope.db.attributes = response.data;
                    });

                GenericModel.read($http, 'AdmHtmlElement')
                    .then(function(response){
                        $scope.db.html_elements = response.data;
                    });

                $scope.condition.formSelected = $scope.dataToCollect.study.DESCRIPTION + '_'
                    + $scope.dataToCollect.visit.VISIT_NAME + '_' + $scope.dataToCollect.sample.SAMPLE_TYPE;
            }
        };

        $scope.filterHtmlElement = function ()
        {

        };

        //init start.
        $scope.dataToCollect = {};
        $scope.db = {};
        $scope.condition = {};
        $scope.setStudy();
        $scope.myConfigUrl = {};
        $scope.myConfigUrl.newForm = myConfig.angularUrl + '/angularjs/prototype/view/edit_form/new_form.html';
        $scope.myConfigUrl.editCopyForm = myConfig.angularUrl + '/angularjs/prototype/view/edit_form/edit_copy_form.html';
        //init end.

    });
