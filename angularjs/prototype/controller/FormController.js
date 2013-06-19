/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/17/13
 * Time: 12:14 PM
 */

SetupPrototype.controller('FormController',
    function($scope, $http, GenericModel, StudyVisitModel, VisitSampleModel){

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

                var date = new Date();
                $scope.condition.formSelected = $scope.dataToCollect.study.DESCRIPTION + '_'
                    + $scope.dataToCollect.visit.VISIT_NAME.replace(' ', '_') + '_' + $scope.dataToCollect.sample.SAMPLE_TYPE;
                $scope.dataToCollect.form.SHORT_DESCRIPTION = $scope.condition.formSelected + '_' + date.getTime();
            }
        };

        $scope.filterHtmlElement = function ()
        {

        };

        $scope.createForm = function ()
        {
            try
            {
                var data = {};
                data.model = 'AdmForm';
                data.data = {};
                data.data.SHORT_DESCRIPTION = $scope.dataToCollect.form.SHORT_DESCRIPTION;
                data.data.STUDY_ID = $scope.dataToCollect.study.ID;
                if (typeof $scope.dataToCollect.form.LONG_DESCRIPTION != 'undefined')
                    data.data.LONG_DESCRIPTION = $scope.dataToCollect.form.LONG_DESCRIPTION;
                GenericModel.create($http, data)
                    .then(function(response) {
                        if (response.data.request == 'success')
                        // The insertion has been performed correctly.
                        {
                            var params = {};
                            params.model = 'AdmForm';
                            params.SHORT_DESCRIPTION = data.data.SHORT_DESCRIPTION;
                            // We want to retrieve the ID of the new element created.
                            GenericModel.read($http, params)
                                .then(function(response){
                                    console.log(response.data);
                                });
                        }
                    });
            }
            catch (e)
            {
                console.log(e);
            }
        }

        //init start.
        $scope.dataToCollect = {};
        $scope.db = {};
        $scope.condition = {};
        $scope.setStudy();
        $scope.myConfigUrl = {};
        $scope.dataToCollect.form = {};
        $scope.myConfigUrl.newForm = myConfig.angularUrl + '/angularjs/prototype/view/edit_form/new_form.html';
        $scope.myConfigUrl.editCopyForm = myConfig.angularUrl + '/angularjs/prototype/view/edit_form/edit_copy_form.html';
        //init end.

    });
