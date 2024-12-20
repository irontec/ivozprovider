import BillableInvoiceCollection from '../../../../fixtures/Provider/BillableCalls/getCollection.json';
import DdisCollection from '../../../../fixtures/Provider/Ddis/getCollection.json';

describe('in BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('invoice-billable_calls');
    cy.before('');
    cy.get('svg[data-testid="DescriptionIcon"]').first().click();
    cy.contains('Invoices').click();

    cy.get('td button > svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('External calls').click();

    cy.get('table').should('contain', DdisCollection.body[0].id);
  });

  it('View details', () => {
    cy.intercept('GET', '**/api/brand/billable_calls/1*', {
      ...BillableInvoiceCollection,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-1'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
