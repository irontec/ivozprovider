'use strict';

angular
    .module('Authentication')
    .factory('Token', function() {

        return function (type, user, pass) {
            
            var date = new Date();
            var dateIso = date.toISOString();
            localStorage.setItem('date-' + type, dateIso);
            
            var cookieKey = 'token-' + type;
            
            localStorage.setItem('auth-type', type);
            
            if (type.match(/basic/i)) {
                
                var base64;
                
                if (user !== null && pass !== null) {
                    var wordArray = CryptoJS.enc.Utf8.parse(user + ':' + pass);
                    base64 = CryptoJS.enc.Base64.stringify(wordArray);
                    
                    localStorage.setItem(cookieKey, base64);
                    
                } else {
                    base64 = localStorage.getItem(cookieKey);
                }
                
                return 'Basic ' + base64;
                
            } else if (type.match(/hmac/i)) {
                
                var code = 183;
                var secret;
                
                if (user !== null && pass !== null) {
                    
                    var md5 = CryptoJS.MD5(pass).toString();
                    secret = CryptoJS.MD5(md5).toString();
                    
                    localStorage.setItem(cookieKey, secret);
                    localStorage.setItem('username', user);
                    
                } else {
                    secret = localStorage.getItem(cookieKey);
                    var user = localStorage.getItem('username');
                }
                
                var digest = CryptoJS.HmacSHA256(secret + '+' + dateIso + '+' + code, secret);
                
                return 'hmac ' + user + ':' + code + ':[' + digest.toString() + ']';
                
            } else {
                
                return '';

            }
            
        };

    });
