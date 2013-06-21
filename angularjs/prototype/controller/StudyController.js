/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/4/13
 * Time: 2:29 PM
 */

SetupPrototype.controller('StudyController',

    function ($scope, $location, $http, GenericModel) {

        $scope.show = function()
        {
            var httpPromise = GenericModel.read($http, 'AdmStudy');
            httpPromise.then(function(response){
                $scope.db.studies = response.data;
            });
        };

        $scope.add = function()
        {
            try
            {
                httpParam.setModel('AdmStudy');
                httpParam.pushData({DESCRIPTION : $scope.dataToCollect.newStudy});
                var httpPromise = GenericModel.create($http, httpParam.flushParams());
                httpPromise.then(function(response){
                    if(response.data.request == 'success')
                    {
                        // Refresh the model.
                        $scope.show();
                        // Reset the field.
                        $scope.dataToCollect.newStudy = '';
                    }
                    else
                        console.log('an error has occured');
                });
            }
            catch (e)
            {
                console.log(e);
            }
        };

        $scope.update = function(study)
        {
            try
            {
                ;
            }
            catch (e)
            {
                console.log(e);
            }
        };

        // start init.
        $scope.db = {};
        $scope.dataToCollect = {};
        $scope.show();
        httpParam.resetParams();
        // end init.
    }
);
