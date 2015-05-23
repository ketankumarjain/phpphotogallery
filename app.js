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
app.controller('PhotograpCtrl', function ($scope, $http) {
    $http.get("http://localhost/phpphotogallery/services/PhotoList.php")
        .success(function (response) {
            if(angular.isArray(response.records)) {
                $scope.Photos = response.records;
                console.log(response);
            }
        })
        .error(function (error) {
            console.log(error)
        });
});
app.controller('PhotoCommentCtrl', function ($scope, $http,$routeParams) {
    $scope.par=$routeParams.id;
    $http.get("http://localhost/photo_gallery/services/PhotoService.php?id="+$routeParams.id)
        .success(function (response) {
            var comments;
            $scope.photo = response.record;
            comments=response.comments;
            comments.shift();
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
            url:"http://localhost/photo_gallery/services/loginProcessing.php",
            data: {
                user: $scope.username,
                pass: $scope.password
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function (response,status) {
            if(status==204) {
                alert("Wrong User");
                document.getElementById("User").value="";
                document.getElementById("Password").value="";

            }else{
                $location.url("/view4");
                console.log(response);
            }
        });
    }
});
app.controller('postCtrl',function($scope,$http,$location){
    $scope.postComment=function() {
        var  posting_id=$scope.photo.id;
        var request = $http({
            method: "post",
            url:"http://localhost/photo_gallery/services/Post.php",
            data: {
                photo_id:posting_id,
                author: $scope.comment.author,
                comment: $scope.comment.body
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function (response,status) {
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
app.controller('deleteCtrl',function($scope,$http,$location){
    $scope.delete_img=function(id) {
         var photoId=id;

        var request = $http({
            method: "post",
            url:"http://localhost/photo_gallery/services/delete_image.php",
            data: {
                photo_id:photoId
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function (response,status) {
            if(status==204) {
                alert("Wrong User");
            }else{
                $location.url('/view4');
            }
        });
    };
    $scope.deleteComment=function(id) {
        var postId = id;
        alert(postId);
        var request = $http({
            method: "post",
            url: "http://localhost/photo_gallery/services/DeletePost.php",
            data: {
                postId: postId
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        request.success(function (response, status) {
            if (status == 204) {
                alert("Wrong User");
            } else {

                console.log(response)
            }
        });
    }
});

