/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/12/13
 * Time: 4:52 PM
 * To change this template use File | Settings | File Templates.
 */

SetupPrototype.service('GenericModel',
    function(){

        var url = myConfig.baseUrl + '/administration/admCRUD';

        this.read = function($http, model)
        // Model is a string.
        {
            return $http.get(url + '/read?model=' + model);
        }

        this.create = function($http, model)
        // Model is an object.
        {
            return $http.post(url + '/create', model);
        }

        this.update = function($http, model)
        // Model is an object
        {
            return $http.post(url + '/update', model);
        }
    });
