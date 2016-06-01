(function customOasisSpinner() {

    if (!window.jQuery || !$.ui || !$.ui.spinner || !$.isFunction($.ui.spinner.prototype._change)) {
        setTimeout(customOasisSpinner,50);
        return;
    }

    $.ui.spinner.prototype._change = function() {
        var self = this, // shortcut
            value = self._parseValue(),
            min = self.options.min,
            max = self.options.max;

        // don't reprocess if change was self triggered
        if (!self.selfChange) {
            if (isNaN(value))
                value = self.curvalue;

            var element = self.element[0];
            var selectedText = element.value.substring(element.selectionStart, element.selectionEnd);
            if (selectedText.length) 
                value = null;

            self._setValue(value, true);
        }
    }

    // performs first step, and starts the spin timer if increment is set
    $.ui.spinner.prototype._startSpin = function(dir, large) {
        // shortcuts
        var self = this,
            options = self.options,
            increment = options.increment;

        // make sure any changes are posted
        self.element[0].selectionStart = self.element[0].selectionEnd = 0;
        self._change();
        self._doSpin(dir * (large ? self.options.largeStep : self.options.step));

        if (increment && increment.length > 0) {
            self.counter = 0;
            self.incCounter = 0;
            self._setTimer(increment[0].delay, dir, large);
        }
    }
})();
