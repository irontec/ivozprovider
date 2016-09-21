'use strict';

angular
    .module('CommonViews')
    .controller('HeaderCtrl', function (
        $scope,
        $rootScope,
        $location,
        $http,
        appConfig
    ) {
    
    var loadData = function() {
        
        if ($rootScope.brand !== undefined) {
            $scope.logo = $rootScope.brand.logo;
            $scope.brandName = $rootScope.brand.brandName;
        }

        if ($location.$$path !== '/login') {
            $scope.nombre = localStorage.getItem('userName');
            $scope.brandName = localStorage.getItem('companyName');

            $http.get(appConfig.urlRest + 'index').success(function(data, status) {
                if (status > 400) {
                    $scope.totalCalls = 0;
                    $scope.totalDetours = 0;
                } else {
                    $scope.totalCalls = data.calls.total;
                    $scope.totalDetours = data.detours.total;
                }
            });
        } else {
            $scope.nombre = '';
        }
        
        var statusTerminal = localStorage.getItem('statusTerminal');
        
        if (statusTerminal === true || statusTerminal === 'true') {
            $scope.statusTerminal = true;
        } else {
            $scope.statusTerminal = false;
        }
        
        if (statusTerminal !== null) {
            $scope.userAgent = localStorage.getItem('userAgent');
            $scope.ipRegistered = localStorage.getItem('ipRegistered');
        }
        
    };
    
    loadData();
    
    $rootScope.$on('$locationChangeSuccess', function() {
        loadData();
    });
    
});