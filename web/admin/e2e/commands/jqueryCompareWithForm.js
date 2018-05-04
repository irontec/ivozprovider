exports.command = function(formData, callback) {
    let client = this;
    this.execute(Compare, [formData], execCallback);

    function Compare(expectedData) {

        let missingFields = [];
        let diffValueFields = [];

        for (let name in expectedData) {

            let element = $(`form:visible [name='${name}']`);

            if (element.attr('type') == 'password') {
                continue;
            }

            if (element.length == 0) {
                missingFields.push(name);
                continue;
            }

            if (element.length > 1) {
                element = element.filter('select:eq(0)');
            }

            let currentValue = element.val()
                ? String(element.val())
                : '';

            if (String(expectedData[name]) != currentValue) {
                diffValueFields.push(
                    'expected '
                    + name
                    + ' value was `'
                    + String(expectedData[name])
                    + '`, `'
                    + String(element.val())
                    + '` found'
                );
            }
        }

        return {
            'missingFields': missingFields,
            'diffValueFields': diffValueFields

        };
    }

    function execCallback(result) {
        if (typeof callback === 'function') {
            callback.call(client, result.value);
        }
    }

    return this;
};
