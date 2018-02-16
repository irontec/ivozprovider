exports.command = function(selector, callback) {
    var client = this;

    this.execute(count, [selector], execCallback);

    function count(selector) {
        return {
            'count': $(selector).length,
            'selector': selector
        };
    }

    function execCallback(result) {
        if (typeof callback === 'function') {
            callback.call(client, result.value);
        }
    }

    return this;
};
