'use strict';

angular
    .module('Authentication')
    .factory('Token', function() {
        return function (type, token) {

            var date = new Date();
            var dateIso = date.toISOString();

            localStorage.setItem('date-' + type, dateIso);
            localStorage.setItem('auth-type', type);
            localStorage.setItem('auth-token', token);
        };
    });
