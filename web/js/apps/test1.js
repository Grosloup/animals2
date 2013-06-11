var app = angular
    .module("app",["ngResource"])
    .config(
        [
            "$interpolateProvider",
            function($interpolateProvider){
                $interpolateProvider.startSymbol("{[{");
                $interpolateProvider.endSymbol("}]}");
            }
        ]
    );
app.factory("Test",function($resource){
    return $resource("/app_dev.php/api/testing/:id", {id:"@id"},{update: 'PUT'});
});
app.controller("MainCtrl", function($scope, Test){
    $scope.basket = [];
    $scope.items = Test.query(function(datas){
        angular.forEach($scope.items, function(item, key){
            item.quantity = 0;
            $scope.basket.push(item);
        });
        console.log($scope.basket);
    });




});
