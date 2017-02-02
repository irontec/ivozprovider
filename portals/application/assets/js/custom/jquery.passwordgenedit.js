;(function load($) {

    if (!$.klear.checkDeps(['$.klearmatrix.edit'],load)) {
        return;
    }

    var __namespace__ = "custom.passwordgen";

    $.custom = $.custom || {};

    $.widget("custom.passwordgen", $.klearmatrix.edit,  {
        options: {
            moduleName: 'new'
        },
        intervalId: null,
        domCache : {},
        _super: $.klearmatrix.module.prototype,
        _parent: $.klearmatrix.edit.prototype,
        _create : function() {
        },
        _init: function() {
            this._parent._init.apply(this);
            this._bind();
         },
        _bind: function() {
            // Get Input field that holds the generated password
            var passwordField = $("[name='password']", this.element.klearModule("getPanel"));

            // Get the generate password button
            var passwordButton = passwordField.next();
            // Add custom class to the button
            passwordButton.addClass("klear-passwordgen");

            // Remove all binded events for the button 
            passwordButton.unbind();
            // Generate a new password on input on click
            passwordButton.bind("click", passwordField, function(event) {
                // Prevent default event for the a href
                event.preventDefault(); 
        
                // Available symbols
                var uppers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                var lowers = "abcdefghijklmnopqrstuvwxyz";
                var numbers = "0123456789";
                var symbols = "!@#$%^&*()-+";

                var rand = function (str) {
                    return str[Math.floor (Math.random () * str.length)];
                };

                // uppers=3, lowers=3, numbers=3, symbols=1
                var password = 
                    rand(uppers) + rand(uppers) + rand(uppers) +
                    rand(lowers) + rand(lowers) + rand(lowers) +
                    rand(numbers) + rand(numbers) + rand(numbers) +
                    rand(symbols);

                // Shuffle the characters
                password = password.split('').sort(function(){return 0.5-Math.random()}).join('');

                // Set generated password into input field
                event.data.val(password);
            });
        },
    });

    $.widget.bridge("custom.passwordgen", $.custom.passwordgen);

})(jQuery);
