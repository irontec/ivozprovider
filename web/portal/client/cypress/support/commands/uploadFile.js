Cypress.Commands.add('uploadFile', (filePath, selector) => {
  cy.fixture(filePath).then((fileContent) => {
    cy.get(selector).then((input) => {
      const blob = new Blob([fileContent], { type: 'text/csv' });
      const file = new File([blob], 'massImport.csv', { type: 'text/csv' });
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      input[0].files = dataTransfer.files;
      cy.wrap(input).trigger('change', { force: true });
    });
  });
});
