import BillableCallsExport from '../../../fixtures/Provider/BillableCalls/billableCallsExport.json';
import BillableCallsCollection from '../../../fixtures/Provider/BillableCalls/getCollection.json';
import BillableCallItem from '../../../fixtures/Provider/BillableCalls/getItem.json';

describe('in BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('External-calls');
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
    cy.intercept('GET', '**/api/brand/billable_calls/105*', {
      ...BillableCallItem,
    }).as('getBillableCall-105');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-105'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('export to CSV', () => {
    cy.intercept(
      'GET',
      '**/api/brand/billable_calls/export*',
      BillableCallsExport
    ),
      'exportCSV';
    cy.get('button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Export to CSV').click();
    cy.get('header').should('contain', 'External calls');
  });
});
