'use strict';

angular
    .module('Authentication')
    .controller('LoginCtrl', function (
        $scope, 
        $rootScope, 
        $location, 
        Authentication, 
        ngProgress
    ) {
        
        /**
         * Reset login status
         */
        Authentication.ClearCredentials();
        
        $scope.login = function () {
            
            ngProgress.start();
            
            $('.form-group').removeClass('has-error');
            $scope.error = false;
            
            Authentication.Login($scope.username, $scope.password, function (response) {
                
                ngProgress.complete();
                
                if (response.success) {
                    Authentication.SetCredentials(
                        $scope.username,
                        $scope.password
                    );
                    
                    localStorage.setItem('statusTerminal', response.statusTerminal);
                    localStorage.setItem('companyName', response.companyName);
                    
                    if (response.statusTerminal) {
                        localStorage.setItem('userAgent', response.userAgent);
                        localStorage.setItem('ipRegistered', response.ipRegistered);
                    }
                    
                    localStorage.setItem('userName', response.userName);
                    
                    $location.path('/');
                    
                } else {
                    $scope.error = true;
                    $('.form-group').addClass('has-error');
                }
                
            });
        };
    
    });