(function(){
    var app=angular.module('myApp');
    app.controller('Ctrl', ['$http',function($http){

        var Photos=this;
        Photos.Products=[];
        $http.get("http://localhost/photo_gallery/services/PhotoList.php")
            .success(function (data){
            Photos.Products=angular.fromJson(data.records);
        });
    }]);
})
();

