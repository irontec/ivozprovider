import InvoiceTemplateItem from '../../../fixtures/InvoiceTemplate/getItem.json';
import newInvoiceTemplate from '../../../fixtures/InvoiceTemplate/post.json';
import editInvoiceTemplate from '../../../fixtures/InvoiceTemplate/put.json';

export const postInvoiceTemplates = () => {
  cy.intercept('GET', '**/api/brand/invoice_templates/1', {
    ...InvoiceTemplateItem,
  }).as('getInvoiceTemplates-1');
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/invoice_templates*',
      response: newInvoiceTemplate.response,
      matchingRules: newInvoiceTemplate.matchingRules,
    },
    'createFixedCostsRel'
  );

  cy.get('[aria-label=Add]').click();
  cy.fillTheForm(newInvoiceTemplate.request);

  cy.get('header').should('contain', 'Invoice templates');

  cy.usePactWait('createFixedCostsRel')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putInvoiceTemplates = () => {
  cy.intercept('GET', '**/api/brand/invoice_templates/1', {
    ...InvoiceTemplateItem,
  }).as('getInvoiceTemplates-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/invoice_templates/${editInvoiceTemplate.response.body.id}`,
      response: editInvoiceTemplate.response,
    },
    'editInvoiceTemplates-1'
  );
  cy.get('svg[data-testid="EditIcon"]').first().click();
  cy.fillTheForm(editInvoiceTemplate.request);
  cy.get('header').should('contain', 'Invoice templates');
  cy.usePactWait(['editInvoiceTemplates-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteInvoiceTemplates = () => {
  cy.intercept('DELETE', '**/api/brand/invoice_templates/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
