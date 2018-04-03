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

            if (expectedData[name] != element.val()) {
                diffValueFields.push(
                    'expected '
                    + name
                    + ' value was '
                    + expectedData[name]
                    + ', '
                    + element.val()
                    + ' found'
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
