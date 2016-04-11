'use strict';

angular
    .module('CommonViews')
    .controller('HeaderCtrl', function (
        $scope,
        $rootScope,
        $location
    ) {
    
    var loadData = function() {
        
        if ($rootScope.brand !== undefined) {
            $scope.logo = $rootScope.brand.logo;
            $scope.brandName = $rootScope.brand.brandName;
        }

        if ($location.$$path !== '/login') {
            $scope.nombre = localStorage.getItem('userName');
            $scope.brandName = localStorage.getItem('companyName');
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