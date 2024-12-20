import FixedCostsItem from '../../../../fixtures/FixedCosts/getItem.json';
import InvoiceFixedCosts from '../../../../fixtures/FixedCostsRelInvoice/getItem.json';
import newInvoiceFixedCosts from '../../../../fixtures/FixedCostsRelInvoice/post.json';
import editInvoiceFixedCosts from '../../../../fixtures/FixedCostsRelInvoice/put.json';

export const postFixedCostsRelInvoice = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/fixed_costs_rel_invoices*',
      response: newInvoiceFixedCosts.response,
      matchingRules: newInvoiceFixedCosts.matchingRules,
    },
    'createInvoiceFixedCosts'
  );

  cy.get('[aria-label=Add]').click();

  const { ...rest } = newInvoiceFixedCosts.request;
  delete rest.invoice;
  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Invoices');

  cy.usePactWait('createInvoiceFixedCosts')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putFixedCostsRelInvoice = () => {
  cy.intercept('GET', '**/api/brand/fixed_costs/1', {
    ...FixedCostsItem,
  }).as('getInvoice-1');

  cy.intercept('GET', '**/api/brand/fixed_costs_rel_invoices/1', {
    ...InvoiceFixedCosts,
  }).as('getInvoiceNumberSequence-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/fixed_costs_rel_invoices/${editInvoiceFixedCosts.response.body.id}`,
      response: editInvoiceFixedCosts.response,
    },
    'editInvoice-1'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editInvoiceFixedCosts.request;
  delete rest.invoice;
  delete rest.fixedCost;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Invoices');

  cy.usePactWait(['editInvoice-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteFixedCostsRelInvoice = () => {
  cy.intercept('DELETE', '**/api/brand/fixed_costs_rel_invoices/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Invoices');

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
