'use strict';

angular
    .module('Calls')
    .controller('CallsCtrl', function (
        $scope,
        Restangular, 
        ngDialog, 
        $translate, 
        ngProgress,
        $http, 
        appConfig,
        $q
    ) {
    
    $scope.formData = {};
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    
    $scope.page = 1;
    $scope.pageSize = 30;
    
    $scope.callsParams = {
        order: '',
        search: {}
    };

    var loadCalls = function (page) {
        ngProgress.start();

        var params = $scope.callsParams.search;

        page = page || 1;
        params._page = page;

        var endpoint = 'my/call_history?';
        if ($scope.callsParams._order) {
            endpoint += $.param({_order: $scope.callsParams._order});
        } else {
            endpoint += $.param({_order: {startTime: "asc"}});
        }

        $http.get(
            appConfig.urlRest + endpoint,
            {headers: {accept: 'application/ld+json'}, params: params}
        ).then(function(calls) {

            if (calls.status >= 400) {
                $scope.totalItems = 0;
                $scope.calls = {};
            } else {
                $scope.totalItems = calls.data['hydra:totalItems'];
                $scope.calls = calls.data['hydra:member'];

                for (var idx in $scope.calls) {
                    var item = $scope.calls[idx];
                    item.duration = Math.ceil(item.duration);
                    if (item.direction === 'inbound') {
                        item.interlocutor = item.caller;
                    } else {
                        item.interlocutor = item.callee;
                    }
                }
            }

            ngProgress.complete();
            $scope.loading = false;
        }, function() {
            ngProgress.complete();
            $scope.loading = false;
        });
        
    };
    
    loadCalls();
    
    $scope.callsOrder = function(newOrder) {

        if (!$scope.callsParams._order) {
            $scope.callsParams._order = {};
        }

        if ('desc' === $scope.callsParams._order[newOrder]) {
            $scope.callsParams._order = {};
            $scope.callsParams._order[newOrder] = 'asc';
        } else {
            $scope.callsParams._order = {};
            $scope.callsParams._order[newOrder] = 'desc';
        }

        loadCalls();
    };

    $scope.DoCtrlPagingAct = function(text, page) {
        loadCalls(page);
    };

    $scope.clickToOpen = function(item) {
        $scope.ngDialogData = item;
        ngDialog.open({
            template: 'views/calls/call-dialog.html',
            scope: $scope
        });
    };

    $scope.getCallsToCsv = function() {
        var defered = $q.defer();
        var promise = defered.promise;
        var params = $scope.callsParams.search;
        params._pagination = false;


        var endpoint = 'my/call_history';
        if ($scope.callsParams._order) {
            endpoint += '?' + $.param({_order: $scope.callsParams._order});
        }

        $http.get(
            appConfig.urlRest + endpoint,
            {headers: {accept: 'application/json'}, params: params}
        ).then(function (data) {
            data.data = filterCsvData(data.data);
            defered.resolve(data);
        });

        return {
            promise: promise,
            title: 'llamadas.csv'
        };
    };

    function filterCsvData(data) {

        for(var idx in data) {

            var interlocutor = data[idx].direction == 'inbound'
                ? data[idx].caller
                : data[idx].callee;

            data[idx] = {
                date: data[idx].startTime,
                interlocutor: interlocutor,
                duration: data[idx].duration,
                type: data[idx].direction
            }
        }

        return data;
    }
    
    $scope.dateNow = moment().format('YYYY/MM/DD');
    
    $scope.viewForm = false;
    $scope.showForm = function() {
        $scope.viewForm = !$scope.viewForm;
    };
    
    $scope.search = function() {
        $scope.page = 1;
        $scope.callsParams.search = {}
        for (var idx in $scope.formData) {
            $scope.callsParams.search[idx] = $scope.formData[idx];
        }

        if ($scope.formData.startTime) {
            var date = $scope.formData.startTime.split('-');
            $scope.callsParams.search.startTime =
                date[2]
                + "-"
                + date[1]
                + "-"
                + date[0];
        }

        loadCalls();
    };
    
    $scope.reset = function() {
        $scope.formData = {};
        $scope.callsParams.search = $scope.formData;
        loadCalls();
    };
    
    $scope.getFormatDate = function(date) {
        return moment(date).format('DD-MM-YYYY HH:mm:ss');
    };
    
    $scope.getDuration = function(time) {
        return parseInt(time) + ' s';
    };
    
});