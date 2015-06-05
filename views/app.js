var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider',function($routeProvider){
    $routeProvider
        .when('/view1', {
            controller: 'PhotograpCtrl',
            templateUrl: 'views/partials/publicview.html'
        })
        .when('/view2/:id', {
            controller: 'PhotoCommentCtrl',
            templateUrl: 'views/partials/PhotoPublicComment.html'
        })
        .when('/view3', {
            controller:'loginCtrl',
            templateUrl: 'views/partials/loginview.html'
        })
        .when('/view4', {
            controller:'PhotograpCtrl',
            templateUrl: 'views/partials/userphotolistview.html'
        })
        .when('/view5/:id', {
            controller:'PhotoCommentCtrl',
            templateUrl: 'views/partials/commentsview.html'
        })
        .otherwise({redirectTo: '/view1'});
}]);
app.controller('PhotograpCtrl', function ($scope,photoService) {
       photoService.allPhotos().success(function (response) {
            if(angular.isArray(response.records)) {
                $scope.Photos = response.records;
            }else {
                $scope.NoContentMesseage=response;
            }
        }).error(function (error) {
            console.log("Something Went Wrong in serverside"+error)
        });
});
app.controller('PhotoCommentCtrl', function ($scope, photoService,$routeParams) {
         photoService.PhotoComment($routeParams.id).success(function (response) {
            var comments;
            $scope.photo = response.record;
            comments=response.comments;
            if(comments.length!=0) {
                $scope.comments = comments;
            }else{
                $scope.msg="No Comments yet";
            }
        })
        .error(function (error) {
            console.log(error)
        });
});
app.controller('loginCtrl',function($scope,$http,$location){
    $scope.login=function() {
        var request = $http({
            method: "post",
            url:"/phpphotogallery/services/loginProcessing.php",
            data: {
                user: $scope.username,
                pass: $scope.password
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function (response,status) {
            if(status==401) {

                $scope.AuthMessagge="Bab user Credintioal";
                document.getElementById("User").value="";
                document.getElementById("Password").value="";

            }else{
                $location.url("/view4");
                console.log(response);
            }
        });
        request.error(function(error){
            $scope.AuthMessagge="Bab user Credintioal";
            console.log("something went wrong");
        })
    }
});
app.controller('postCtrl',function($scope,photoService,$location){
    $scope.postComment=function() {
        var  posting_id=$scope.photo.id;
        var data = {
            photo_id: posting_id,
            author: $scope.comment.author,
            comment: $scope.comment.body
        }
        photoService.create(data).success(function (response,status) {
            if(status==204) {
                alert("Something Went Wrong");
                document.getElementById("body").value="";
                document.getElementById("author").value="";

            }else{
                $location.path("/view1");
                document.getElementById("body").value="";
                document.getElementById("author").value="";
            }
        });
    }
});
app.controller('deleteCtrl',function($scope,$location,photoService){
    $scope.delete_img=function(id) {
        var data={
            photo_id: id
        }
        photoService.delete("delete_image.php",data).success(function (response) {
            $location.url('/view3');
        });
    };
    $scope.deleteComment=function(id) {
        var data={
            postId: id
        }
        photoService.delete("DeletePost.php",data).success(function (response, status) {
            if (status == 204) {
                alert("Bad User Credential");
            } else {
                console.log(response)
            }
        });
    }
});
app.factory('photoService', function($http) {
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
