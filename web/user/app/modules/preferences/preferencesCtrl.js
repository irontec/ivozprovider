'use strict';

angular
    .module('Preferences')
    .controller('PreferencesCtrl', function (
        $scope,
        $timeout,
        $state,
        ngProgress,
        Restangular,
        appConfig,
        $http
    ) {

    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.user = {};
    $scope.timeZones = [];
    $scope.assistants = {};
    $scope.bossAssistantActive = false;
    $scope.temp = {};

    $http.get(
      appConfig.urlRest + 'timezones?_pagination=false',
      {
        headers: {accept: 'application/json'}
      }
    ).then(function(response) {
        for (var i = 0; i < response.data.length; i++) {
            $scope.timeZones[i] = {
                'id' : response.data[i].id,
                'tz' : response.data[i].tz
            };
        }

        requestCompanyUsers();
    });

    function requestCompanyUsers() {

      $http.get(
        appConfig.urlRest + 'my/company_assistants',
        {
          headers: {accept: 'application/json'}
        }
      ).then(requestCompanyUsersHandler);
    }

    function requestCompanyUsersHandler(response) {
        $scope.assistants = response.data;

        for (var idx in $scope.assistants) {

            $scope.assistants[idx].fullname = $scope.assistants[idx].name + " " + $scope.assistants[idx].lastname;
        }

        $http.get(
            appConfig.urlRest + 'my/profile',
            {headers: {accept: 'application/json'}}
        ).then(function(response) {
            $scope.user = response.data;
            $scope.user.formType = 'preferences';

            for (var i = 0; i < $scope.timeZones.length; i++) {
                if ($scope.timeZones[i].id == $scope.user.timezone.id) {

                    $scope.user.timezoneSelect = $scope.timeZones[i];
                    break;
                }
            }

            $scope.user.doNotDisturb = $scope.user.doNotDisturb ?  '1' : '0';
            $scope.user.maxCalls = Number($scope.user.maxCalls);

            $scope.loading = false;
            ngProgress.complete();
        });
    }

    $scope.$watch('user.bossAssistantId', function(data) {
        if (data === 'null' || data === null) {
            $scope.bossAssistantActive = false;
        } else {
            $scope.bossAssistantActive = true;
        }
    });

    $scope.save = function() {
        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;

        if ($scope.user.bossAssistantId === '') {
            $scope.user.bossAssistantId = null;
        }

        ngProgress.start();
        var data = {
            "name": $scope.user.name,
            "lastname": $scope.user.lastname,
            "email": $scope.user.email,
            "doNotDisturb": $scope.user.doNotDisturb,
            "isBoss": $scope.user.isBoss,
            "maxCalls": $scope.user.maxCalls,
            "bossAssistant": $scope.user.bossAssistant ? $scope.user.bossAssistant.id : null,
            "timezone": $scope.user.timezone ? $scope.user.timezone.id : null
        };

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
                $state.go('app.preferences');
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

});
