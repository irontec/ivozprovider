(function customOasisTooltip() {

    if (!window.jQuery || !$.ui || !$.ui.tooltip || !$.isFunction($.ui.tooltip.prototype.open)) {
        setTimeout(customOasisTooltip,500);
        return;
    }

    $.ui.tooltip.prototype.open = function(event) {
            var target = this.element;
            // already visible? possible when both focus and mouseover events occur
            if (this.current && this.current[0] == target[0])
                return;
            var self = this;
            this.current = target;
            target.removeAttr("title");
            var content = this.options.content.call(target[0], function(response) {
                // IE may instantly serve a cached response, need to give it a chance to finish with _show before that
                setTimeout(function() {
                    // ignore async responses that come in after the tooltip is already hidden
                    if (self.current == target)
                        self._show(event, target, response);
                }, 13);
            });
            if (content) {
                self.showTimeout = setTimeout(function() {
                    self._show(event, target, content);
                }, 800);
            }
    }

})();
