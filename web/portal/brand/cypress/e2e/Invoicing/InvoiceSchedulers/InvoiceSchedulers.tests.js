import InvoiceSchedulers from '../../../fixtures/Provider/InvoiceScheduler/getItem.json';
import newInvoiceSchedulers from '../../../fixtures/Provider/InvoiceScheduler/post.json';
import editInvoiceSchedulers from '../../../fixtures/Provider/InvoiceScheduler/put.json';

export const postInvoiceSchedulers = () => {
  cy.intercept('GET', '**/api/brand/invoice_schedulers/1', {
    ...InvoiceSchedulers,
  }).as('getInvoiceSchedulers-1');
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/invoice_schedulers*',
      response: newInvoiceSchedulers.response,
      matchingRules: newInvoiceSchedulers.matchingRules,
    },
    'createInvoiceSchedulers'
  );

  cy.get('[aria-label=Add]').click();

  const { ...rest } = newInvoiceSchedulers.request;
  delete rest.lastExecution;
  delete rest.lastExecutionError;
  delete rest.nextExecution;
  delete rest.brand;
  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Invoice Schedulers');

  cy.usePactWait('createInvoiceSchedulers')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putInvoiceSchedulers = () => {
  cy.intercept('GET', '**/api/brand/invoice_schedulers/1', {
    ...InvoiceSchedulers,
  }).as('getInvoiceSchedulers-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/invoice_schedulers/${editInvoiceSchedulers.response.body.id}`,
      response: editInvoiceSchedulers.response,
    },
    'editInvoiceNumberSequences-1'
  );
  cy.get('svg[data-testid="EditIcon"]').first().click();
  const { name, unit, email } = editInvoiceSchedulers.request;
  cy.fillTheForm({ name, unit, email });

  cy.get('header').should('contain', 'Invoice Schedulers');
  cy.usePactWait(['editInvoiceNumberSequences-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteInvoiceSchedulers = () => {
  cy.intercept('DELETE', '**/api/brand/invoice_schedulers/*', {
    statusCode: 204,
  }).as('deleteInvoiceNumberSequences');

  cy.get('td button > svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteInvoiceNumberSequences'])
    .its('response.statusCode')
    .should('eq', 204);
};
