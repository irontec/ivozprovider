Cypress.Commands.add('uploadFile', (filePath, selector, mimeType, type) => {
  const fileName = filePath.split('/').pop();
  cy.readFile(filePath, type).then((fileContent) => {
    const blob = new Blob([fileContent], { type: mimeType });
    const file = new File([blob], fileName, {
      type: mimeType,
    });
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    cy.get(selector).then((input) => {
      input[0].files = dataTransfer.files;
      cy.wrap(input).trigger('change', { force: true });
    });
  });
});
