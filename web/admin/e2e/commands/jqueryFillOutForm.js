exports.command = function(formData, callback) {
    let client = this;
    this.execute(fillOut, [formData], execCallback);

    function fillOut(formData) {

        let missingFields = [];
        for (let name in formData) {

            let values = formData[name];
            let element = $(`form:visible [name='${name}']`);

            if (element.length == 0) {
                missingFields.push(name);
            }

            let fieldType = null;
            if (element.length > 1) {
                element = element.filter(':eq(0)');
                fieldType = 'select';
            }

            switch(fieldType) {
                case 'select':

                    element.find(`option`).each(() => {
                       $(this).prop('selected', false);
                    });

                    if (!Array.isArray(values)) {
                        values = [values];
                    }

                    for (let value of values) {
                        element
                            .find(`option[value='${value}']`)
                            .prop('selected', true);
                    }
                    break;

                default:
                    element.val(values);
            }
            element.change();
        }

        return {'missingFields': missingFields};
    }

    function execCallback(result) {
        if (typeof callback === 'function') {
            callback.call(client, result.value);
        }
    }

    return this;
};
