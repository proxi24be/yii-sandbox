/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/5/13
 * Time: 4:12 PM
 */

SetupPrototype.controller('VisitController',
    function($scope, $http, GenericModel, StudyVisitModel){

        $scope.setStudies = function()
        {
            GenericModel.read($http,'AdmStudy').then(function(response){
                $scope.db.studies = response.data;
            });
        }

        $scope.setVisits = function()
        {
            GenericModel.read($http, 'AdmVisit').then(function(response){
                $scope.db.visits = response.data;
            });
        }

        $scope.add = function()
        {
            try
            {
                $scope.dataToCollect.visit = {};
                $scope.dataToCollect.visit.model = 'AdmVisit';
                $scope.dataToCollect.visit.data = $scope.dataToCollect.newVisit;
                GenericModel.create($http, $scope.dataToCollect.visit)
                    .then(function(response){
                        if (response.data.request =='success')
                        {
                            $scope.setVisits();
                            $scope.dataToCollect.newVisit.VISIT_NAME = '';
                            $scope.dataToCollect.newVisit.VISIT_INTERVAL ='';
                            // Refresh the model.
                            $scope.showFreeVisit();
                        }
                        else
                        {
                            // display error message.
                        }
                    });
            }
            catch (e)
            {

            }
        };

        $scope.update = function(visit)
        // visit is an object.
        {
            GenericModel.update($http, visit)
                .then(function(response){
                    console.log(response);
                    $scope.setVisits();
                });
        };

        $scope.attach = function()
        // Attach visit(s) to study.
        {
            try
            {
                var data = {};
                var i = 0 ;
                var studyID = $scope.dataToCollect.study.ID ;
                var array = new Array();

                for (index in $scope.dataToCollect.visits)
                    array[i++] = {STUDY_ID : studyID, VISIT_ID : $scope.dataToCollect.visits[index].ID};

                data.model = 'AdmStudyVisit';
                data.data = array;
                GenericModel.create($http, data)
                    .then(function(response){
                        if(response.data.request == 'success')
                        {
                            console.log('operation completed');
                            $scope.showFreeVisit();
                            $scope.showAttachedVisit();
                        }
                        else
                            console.log('operation failed');
                    });
            }
            catch (e)
            {
                console.log(e);
            }
        };

        $scope.showFreeVisit = function()
        {
            if (typeof $scope.dataToCollect.study != 'undefined')
            {
                StudyVisitModel.readFreeVisit($http, $scope.dataToCollect.study)
                    .then(function(response){
                        $scope.db.freeVisits = response.data;
                    });
            }

        };

        $scope.showAttachedVisit = function()
        {
            if (typeof $scope.dataToCollect.study != 'undefined')
            {
                StudyVisitModel.readAttachedVisit($http, $scope.dataToCollect.study)
                    .then(function(response){
                        $scope.db.attachedVisits = response.data;
                    });
            }
        };

        // init start.
        $scope.db = {};
        $scope.dataToCollect = {};
        $scope.setStudies();
        $scope.setVisits();
        bootstrap.init();
        // init end.
    });


var bootstrap = {

    init : function()
    {
        bootstrap.popover();
    },
    popover : function()
    {
        // Display the popover on click event.
        $('.toolTip').popover({
            trigger : 'click',
            placement : 'bottom'
        });

        // Hide when the element lost the focus.
        $('.toolTip').focusout(function(){
            $(this).popover('hide');
        });

    }

}