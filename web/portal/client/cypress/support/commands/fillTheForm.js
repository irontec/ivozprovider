Cypress.Commands.add('fillTheForm', (values) => {
  for (const idx in values) {
    if (idx === 'id') {
      continue;
    }

    if (values[idx] === null) {
      continue;
    }

    cy.get(`form *[name="${idx}"]`).then((input) => {
      const tag = input.prop('tagName').toLowerCase();
      const role = input.attr('role');
      const type = input.attr('type');
      let value = values[idx];

      if (tag === 'textarea') {
        cy.get(`textarea[name=${idx}]`).clear().type(value, { delay: 1 });

        return;
      }

      if (type === 'checkbox') {
        if (value) {
          cy.get(`input[name=${idx}]`).check();
        } else {
          cy.get(`input[name=${idx}]`).uncheck();
        }

        return;
      }

      if (type && !role) {
        //type number, text, etc.
        cy.get(`input[name=${idx}]`).clear().type(value, { delay: 1 });

        return;
      }

      // Selectboxes & Comboboxes (autocomplete)
      if (value === true) {
        value = '1';
      } else if (value === false) {
        value = '0';
      }

      if (role === 'combobox') {
        cy.get(`input[name="${idx}"]`).click().clear().type('{downArrow}');
      } else {
        cy.get(`div[id=mui-component-select-${idx}]`).click();
        cy.get(`ul.MuiList-root li[data-value=${value}]`).click();
      }
    });
  }

  cy.contains('Save').click();
});
