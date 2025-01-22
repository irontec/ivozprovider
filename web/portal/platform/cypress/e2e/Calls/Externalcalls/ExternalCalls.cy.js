import BillableCallsExport from '../../../fixtures/ExternalCalls/billableCallsExport.json';
import BillableCallsCollection from '../../../fixtures/ExternalCalls/getCollection.json';

describe('in BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('invoice-billable_calls');
    cy.before('');
    cy.contains('Calls').click();
    cy.contains('External calls').click();

    cy.get('header').should('contain', 'External calls');
    cy.get('table').should('contain', BillableCallsCollection.body[0].ddi);
  });

  it('Delete is disabled', () => {
    cy.get('button.Mui-disabled > [data-testid="DeleteIcon"]').should('exist');
  });

  it('View details', () => {
    cy.intercept('GET', '**/api/platform/billable_calls/1*', {
      ...BillableCallsCollection,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-1'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('export to CSV', () => {
    cy.intercept(
      'GET',
      '**/api/client/billable_calls/export*',
      BillableCallsExport
    ),
      'exportCSV';
    cy.get('button svg[data-testid="CloudDownloadIcon"]').first().click();
    cy.get('header').should('contain', 'External calls');
  });
});
