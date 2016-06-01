(function customOasisTooltip() {

    if (!window.jQuery) {
        setTimeout(customOasisTooltip,50);
        return;
    }

    $.widget("ui.tooltip", {
        options: {
            tooltipClass: "ui-widget-content",
            content: function() {
                return $(this).data("tooltip-content");
            },
            position: {
                my: "center bottom",
                at: "center bottom",
                offset: "40 40"
            }
        },
        _init: function() {
            var self = this;
            this.showTimeout = null;
            this.tooltip = $("<div></div>")
                .attr("id", "ui-tooltip-" + increments++)
                .attr("role", "tooltip")
                .attr("aria-hidden", "true")
                .addClass("ui-tooltip ui-widget ui-corner-all")
                .addClass(this.options.tooltipClass)
                .appendTo(document.body)
                .hide();
            this.tooltipContent = $("<div></div>")
                .addClass("ui-tooltip-content")
                .appendTo(this.tooltip);
            this.opacity = this.tooltip.css("opacity");
            this.element
                .on("focus.tooltip mouseenter.tooltip", function(event) {
                    self.open( event );
                })
                .on("blur.tooltip mouseleave.tooltip", function(event) {
                    self.close( event );
                })
                .data('tooltip-content',this.element.attr('title'));
        },
    
        enable: function() {
            this.options.disabled = false;
        },
    
        disable: function() {
            this.options.disabled = true;
        },
    
        destroy: function() {
            this.tooltip.remove();
            $.Widget.prototype.destroy.apply(this, arguments);
        },
    
        widget: function() {
            return this.element.pushStack(this.tooltip.get());
        },
    
        open: function(event) {
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
        },
    
        _show: function(event, target, content) {
            if (!content)
                return;
    
            if (this.options.disabled)
                return;
            this.tooltipContent.html(content);
            this.tooltip.css({
                top: 0,
                left: 0
            }).show().position( $.extend({
                of: target
            }, this.options.position )).hide();
    
            if (parseInt(this.tooltip.css('left').replace(/px/, ''))+this.tooltip.width() > window.innerWidth) {
                this.tooltip.css('left',(window.innerWidth - (this.tooltip.width() + this.tooltip.width()/2 )) + 'px');
            }
    
            this.tooltip.attr("aria-hidden", "false");
            target.attr("aria-describedby", this.tooltip.attr("id"));
    
            this.tooltip.stop(false, true).fadeIn();
    
            this._trigger( "open", event );
        },
    
        close: function(event) {
    
            if (!this.current)
                return;
    
            var current = this.current.attr("title", this.options.content.call(this.current));
            this.current = null;
    
            if (this.options.disabled)
                return;
    
            clearTimeout(this.showTimeout);
    
            current.removeAttr("aria-describedby");
            this.tooltip.attr("aria-hidden", "true");
    
            this.tooltip.stop(false, true).fadeOut();
            this._trigger( "close", event );
        }
    
    });

})();
