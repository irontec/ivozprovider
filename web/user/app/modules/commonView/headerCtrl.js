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

            $http.get(appConfig.urlRest + 'my/call_stats').success(function(data, status) {
                if (status >= 400) {
                    $scope.totalCalls = 0;
                    $scope.totalDetours = 0;
                } else {
                    $scope.totalCalls = data.totalCalls;
                    $scope.totalDetours = data.totalDetours;
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

        var gsQRCode = localStorage.getItem('gsQRCode');
        if (gsQRCode == "true") {

            var terminalName = localStorage.getItem('terminalName');
            var terminalPassword = localStorage.getItem('terminalPassword');
            var extensionNumber = localStorage.getItem('extensionNumber');
            var companyName = localStorage.getItem('companyName');
            var companyDomain = localStorage.getItem('companyDomain');
            var userName = localStorage.getItem('userName');
            var voiceMail = localStorage.getItem('voiceMail');

            // https://stackoverflow.com/a/20856346
            var QrSafeUserName = userName.replace(/[^\x00-\x7F]/g, ' ');

            $scope.gsQRCode = true;
            $scope.QRCode = '<?xml version="1.0" encoding="utf-8"?>'
                + '<AccountConfig version="1"><Account>'
                + '<RegisterServer>' + companyDomain + '</RegisterServer>'
                + '<UserID>' + terminalName + '</UserID>'
                + '<AuthID>' + terminalName + '</AuthID>'
                + '<AuthPass>' + terminalPassword + '</AuthPass>'
                + '<AccountName>' + extensionNumber + ' ' + companyName + '</AccountName>'
                + '<DisplayName>' + QrSafeUserName + '</DisplayName>'
                + '<Voicemail>' + voiceMail + '</Voicemail>'
                + '</Account>'
                + '</AccountConfig>';

        } else {

            $scope.gsQRCode = false;
            $scope.QRCode = '';
        }
    };

    loadData();

    $rootScope.$on('$locationChangeSuccess', function() {
        loadData();
    });

});
