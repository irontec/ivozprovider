import newInvoiceTemplate from '../../fixtures/InvoiceTemplate/post.json';
import editInvoiceTemplate from '../../fixtures/InvoiceTemplate/put.json';

export const postInvoiceTemplate = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/invoice_templates*',
      response: newInvoiceTemplate.response,
      matchingRules: newInvoiceTemplate.matchingRules,
    },
    'createInvoiceTemplate'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newInvoiceTemplate.request);

  cy.get('header').should('contain', 'Default Invoice templates');

  cy.usePactWait('createInvoiceTemplate')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putInvoiceTemplate = () => {
  cy.intercept('GET', '**/api/platform/invoice_templates/1', {
    ...editInvoiceTemplate,
  }).as('getInvoiceTemplate-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/invoice_templates/${editInvoiceTemplate.response.body.id}`,
      response: editInvoiceTemplate.response,
    },
    'editInvoiceTemplate'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editInvoiceTemplate.request);

  cy.get('header').should('contain', 'Default Invoice templates');

  cy.usePactWait(['editInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteInvoiceTemplate = () => {
  cy.intercept('DELETE', '**/api/platform/invoice_templates/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Default Invoice templates');

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
