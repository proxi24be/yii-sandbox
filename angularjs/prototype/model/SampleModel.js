/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/11/13
 * Time: 3:34 PM
 * To change this template use File | Settings | File Templates.
 */


SetupPrototype.service('SampleModel',
    function(){

        var url = myConfig.baseUrl + '/biotracking/AdmSample';

        this.read = function ($http)
        {
          return $http.get(url + '/read');
        };

    });