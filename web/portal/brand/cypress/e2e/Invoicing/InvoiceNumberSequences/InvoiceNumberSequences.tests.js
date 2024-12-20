import InvoiceNumberSequencesItem from '../../../fixtures/InvoiceNumberSequence/getItem.json';
import newInvoiceNumberSequences from '../../../fixtures/InvoiceNumberSequence/post.json';
import editInvoiceNumberSequences from '../../../fixtures/InvoiceNumberSequence/put.json';

export const postInvoiceNumberSequences = () => {
  cy.intercept('GET', '**/api/brand/invoice_number_sequences/1', {
    ...InvoiceNumberSequencesItem,
  }).as('getInvoiceNumberSequences-1');
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/invoice_number_sequences*',
      response: newInvoiceNumberSequences.response,
      matchingRules: newInvoiceNumberSequences.matchingRules,
    },
    'createInvoiceNumberSequences'
  );

  cy.get('[aria-label=Add]').click();

  const { ...rest } = newInvoiceNumberSequences.request;
  delete rest.version;
  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Invoice number sequences');

  cy.usePactWait('createInvoiceNumberSequences')
    .its('response.statusCode')
    .should('eq', 200);
};

export const putInvoiceNumberSequences = () => {
  cy.intercept('GET', '**/api/brand/invoice_number_sequences/1', {
    ...InvoiceNumberSequencesItem,
  }).as('getInvoiceNumberSequences-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/invoice_number_sequences/${editInvoiceNumberSequences.response.body.id}`,
      response: editInvoiceNumberSequences.response,
    },
    'editInvoiceNumberSequences-1'
  );
  cy.get('svg[data-testid="EditIcon"]').first().click();
  const { ...rest } = editInvoiceNumberSequences.request;
  delete rest.prefix;
  delete rest.sequenceLength;
  delete rest.increment;
  delete rest.latestValue;
  delete rest.iteration;
  delete rest.version;
  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Invoice number sequences');
  cy.usePactWait(['editInvoiceNumberSequences-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteInvoiceNumberSequences = () => {
  cy.intercept('DELETE', '**/api/brand/invoice_number_sequences/*', {
    statusCode: 204,
  }).as('deleteInvoiceNumberSequences');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteInvoiceNumberSequences'])
    .its('response.statusCode')
    .should('eq', 204);
};
