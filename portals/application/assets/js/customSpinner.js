(function customOasisSpinner() {

    if (!window.jQuery || !$.ui || !$.ui.spinner || !$.isFunction($.ui.spinner.prototype._change)) {
        setTimeout(customOasisSpinner,50);
        return;
    }

    $.ui.spinner.prototype._validate = function(value) {

        var self = this, // shortcut
            options = this.options,
            min = options.min,
            max = options.max;

        if ((value == null) && !options.allowNull)
            value = this.curvalue != null ? this.curvalue : min || max || 0; // must confirm not null in case just initializing and had blank value

        var element = self.element[0];
        if (element &&
            (
                element.type === 'text' ||
                element.type === 'search' ||
                element.type === 'password' ||
                element.type === 'url' ||
                element.type === 'tel'
            )) {
            var selectedText = element.value.substring(element.selectionStart, element.selectionEnd);
            if (selectedText.length) {
                value = self.value = null;
                return value;
            }
        }

        if ((max != null) && (value > max))
            return max;
        else if ((min != null) && (value < min))
            return min;
        else
            return value;

    }

    // performs first step, and starts the spin timer if increment is set
    $.ui.spinner.prototype._startSpin = function(dir, large) {
        // shortcuts
        var self = this,
            options = self.options,
            increment = options.increment;

        // make sure any changes are posted
        var element = self.element[0];
        if (element &&
            (
                element.type === 'text' ||
                element.type === 'search' ||
                element.type === 'password' ||
                element.type === 'url' ||
                element.type === 'tel'
            )) {
            self.element[0].selectionStart = self.element[0].selectionEnd = 0;
        }
        self._change();
        self._doSpin(dir * (large ? self.options.largeStep : self.options.step));

        if (increment && increment.length > 0) {
            self.counter = 0;
            self.incCounter = 0;
            self._setTimer(increment[0].delay, dir, large);
        }
    }
})();
