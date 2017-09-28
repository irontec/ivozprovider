exports.command = function(formData) {

    this.execute(fillOut, [formData]);

    function fillOut(formData) {

        for (let name in formData) {

            let values = formData[name];
            let element = $(`form:visible [name='${name}']`);

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

                    for (let value of values) {
                        element.find(`option[value='${value}']`).prop('selected', true)
                    }
                    break;

                default:
                    element.val(values);
            }

            element.change();
        }
    }

    return this;
};
