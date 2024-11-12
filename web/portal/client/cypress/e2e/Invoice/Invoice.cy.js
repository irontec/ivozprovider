import InvoiceCollection from '../../fixtures/Invoices/getCollection.json';

describe('Invoice', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Invoices');
    cy.before();

    cy.contains('Billing').click();
    cy.contains('Invoices').click();

    cy.get('header').should('contain', 'Invoice');

    cy.get('table').should('contain', InvoiceCollection.body[0].number);
  });

  it('has disabled  buttons', () => {
    cy.get('[data-testid="EditIcon"]').first().should('not.be.enabled');
    cy.get('[data-testid="DeleteIcon"]').first().should('not.be.enabled');
  });
});
