'use strict';
angular
    .module('Account')
    .controller('AccountCtrl', function (
        $scope, 
        $state,
        ngProgress,
        appConfig,
        $http
    ) {
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.user = {};

    $http.get(
        appConfig.urlRest + 'my/profile',
        {headers: {accept: 'application/json'}}
    ).then(function(response) {
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

        var data = {};
        for (var idx in $scope.user) {
            data[idx] = $scope.user[idx];
        }

        delete data['pass'];
        delete data['timezone'];
        delete data['bossAssistant'];

        if ($scope.user.changePass) {
            data['pass'] = $scope.user.newPass;
            data['oldPass'] = $scope.user.currentPass;
        }

        $http.put(
            appConfig.urlRest + 'my/profile',
            data,
            {headers: {accept: 'application/json'}}
        ).then(
            accountUpdateSuccessHandler,
            accountUpdateErrorHandler
        );

        function accountUpdateSuccessHandler(response) {

            if (response.status >= 400) {

                $scope.formAction = true;
                $scope.error = true;

                var errorMessage = response.statusText;
                if (response.data.detail !== undefined) {
                    errorMessage = response.data.detail;
                }
                $scope.errorMessage = errorMessage;
                $scope.formAction = false;

            } else {

                $scope.success = true;
                $state.go('app.account');

            }

            ngProgress.complete();
        }

        function accountUpdateErrorHandler(response) {

            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = response.data.error;
            $scope.formAction = false;
            ngProgress.complete();
        }
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