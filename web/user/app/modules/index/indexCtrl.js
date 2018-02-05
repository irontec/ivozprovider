'use strict';

angular
    .module('Index')
    .controller('IndexCtrl', function (
        $scope,
        Restangular,
        ngProgress,
        appConfig,
        $http
    ) {

    ngProgress.color('blue');
    ngProgress.start();

    $scope.totalCalls = 0;
    $scope.totalDetours = 0;

    $http.get(appConfig.urlRest + 'my/call_stats').success(function(data, status) {

        ngProgress.complete();
        if (status > 400) {
            $scope.totalCalls = 0;
            $scope.totalDetours = 0;
        } else {
            $scope.totalCalls = data.totalCalls;
            $scope.totalDetours = data.totalDetours;
        }
    });
});
