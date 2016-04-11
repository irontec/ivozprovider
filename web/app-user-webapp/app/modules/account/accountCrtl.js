'use strict';
angular
    .module('Account')
    .controller('AccountCtrl', function (
        $scope, 
        $state,
        ngProgress,
        Restangular
    ) {
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.user = {};
    
    Restangular.all('users').get(1).then(function(response) {
        $scope.user = response.data;
        $scope.user.formType = 'account';
        $scope.loading = false;
        ngProgress.complete();
    });
    
    $scope.passInvalid = false;
    
    var checkPassValid = function() {
        var user = $scope.user;
        
        if (user.changePass === undefined || user.changePass === false) {
            $scope.passInvalid = false;
            $scope.user.currentPass = '';
            $scope.user.newPass = '';
            $scope.user.repeatPass = '';
            return;
        }
        
        if (user.currentPass === undefined || user.newPass === undefined || user.repeatPass === undefined) {
            $scope.passInvalid = true;
            return;
        }

        if (user.currentPass === '' || user.newPas === '' || user.repeatPass === '') {
            $scope.passInvalid = true;
            return;
        }
        
        if (user.newPass !== user.repeatPass) {
            $scope.passInvalid = true;
            return;
        }
        
        $scope.passInvalid = false;
    };
    
    $scope.$watchGroup(['user.currentPass', 'user.newPass', 'user.repeatPass'], function() {
        checkPassValid();
    });
    
    $scope.save = function() {
        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;
        
        ngProgress.start();
        $scope.user.put().then(function(response) {
            
            if (response.status > 400) {

                $scope.formAction = true;
                $scope.error = true;
                
                var errorMessage = response.statusText;
                if (response.data.error !== undefined) {
                    errorMessage = response.data.error;
                }
                $scope.errorMessage = errorMessage;
                $scope.formAction = false;
                
            } else {
                
                if ($scope.user.changePass) {
                    
                    var md5 = CryptoJS.MD5($scope.user.newPass).toString();
                    var secret = CryptoJS.MD5(md5).toString();
                    
                    localStorage.setItem('token-Hmac', secret);
                    
                }
                
                localStorage.setItem('userName', $scope.user.name + ' ' + $scope.user.lastname);
                
                $scope.success = true;
                $state.go('app.account');
                
            }
            
            ngProgress.complete();
        }, function(response) {
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = response.data.error;
            $scope.formAction = false;
            ngProgress.complete();
        });
    };
    
    $scope.nameEmpty = false;
    $scope.$watch('user.name', function(data) {
        if (data === '' || data === undefined) {
            $scope.nameEmpty = true;
        } else {
            $scope.nameEmpty = false;
        }
    });
    
    $scope.lastNameEmpty = false;
    $scope.$watch('user.lastname', function(data) {
        if (data === '' || data === undefined) {
            $scope.lastNameEmpty = true;
        } else {
            $scope.lastNameEmpty = false;
        }
    });
    
    $scope.emailEmpty = false;
    $scope.$watch('user.email', function(data) {
        if (data === '' || data === undefined) {
            $scope.emailEmpty = true;
        } else {
            $scope.emailEmpty = false;
        }
    });
    
});