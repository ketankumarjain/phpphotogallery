/**
 * Created by ketan on 5/31/2015.
 */
angular.module('myApp').factory('photoService', function($http) {
    var BASE_URL = '/phpphotogallery/services/';
    return {
        allPhotos: function() {
            return $http.get(BASE_URL+"/"+"PhotoList.php");
        },
        create: function(post) {
            return $http.post(BASE_URL+"/"+"Post.php", post);
        },
        delete: function(subpath,data) {
            return $http.post(BASE_URL + '/'+subpath, data,{'Content-Type': 'application/x-www-form-urlencoded'});
        },
        PhotoComment:function(id){
            return $http.get(BASE_URL+"/"+"PhotoService.php?id="+id);
        }
    };
});
