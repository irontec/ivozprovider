Cypress.Commands.add('fillTheForm', (fixture) => {
  for (const [idx, values] of Object.entries(fixture)) {
    if (idx === 'id') {
      continue;
    }

    if (values === null) {
      continue;
    }

    const multilangValidValues = ['en', 'es', 'ca', 'it'];
    const multilangValidForm = multilangValidValues.every((key) =>
      values.hasOwnProperty(key)
    );

    if (multilangValidForm) {
      multilangValidValues.forEach((lang) => {
        _fillTheForm(`${idx}.${lang}`, values[lang]);
      });
      continue;
    }

    _fillTheForm(idx, values);
  }

  cy.contains('Save').click();
});

const _fillTheForm = (idx, data) => {
  cy.get(`form *[name="${idx}"]`).then((input) => {
    const tag = input.prop('tagName').toLowerCase();
    const role = input.attr('role');
    const type = input.attr('type');
    let value = data;

    if (tag === 'textarea') {
      cy.get(`textarea[name="${idx}"]`).clear().type(value, { delay: 1 });

      return;
    }

    if (type === 'checkbox') {
      if (value) {
        cy.get(`input[name="${idx}"]`).check();
      } else {
        cy.get(`input[name="${idx}"]`).uncheck();
      }

      return;
    }

    if (type && !role) {
      //type number, text, etc.
      cy.get(`input[name="${idx}"]`).clear().type(value, { delay: 1 });

      return;
    }

    // Selectboxes & Comboboxes (autocomplete)
    if (value === true) {
      value = '1';
    } else if (value === false) {
      value = '0';
    }

    if (role === 'combobox') {
      if (Array.isArray(value)) {
        return;
      }
      cy.get(`input[name="${idx}"]`).click().clear().type('{downArrow}');

      cy.get(`li[data-value=${value}]`).click();
    } else {
      cy.get(`div[id=mui-component-select-${idx}]`).click();
      cy.get(`ul.MuiList-root li[data-value=${value}]`).click();
    }
  });
};
