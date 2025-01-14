import BillableCallItem from '../../../../fixtures/BillableCall/getItem.json';
import DdiResidentialCollection from '../../../../fixtures/Ddi/getResidentialCollection.json';

describe('Ddi Residential ExternalCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ddi');
    cy.before();

    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdiResidentialCollection.body[0].ddie164);

    cy.get('svg[data-testid="ChatBubbleIcon"]').first().click();
  });

  it('View details', () => {
    cy.intercept('GET', '**/api/client/billable_calls/*', {
      ...BillableCallItem,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-1'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('export to CSV', () => {
    cy.intercept('GET', '**/api/client/billable_calls/export*', {
      statusCode: 200,
      headers: {
        'Content-Type': 'application/json; charset=utf-8',
      },
      body: {
        success: true,
        errorMsg: '',
        failed: 0,
      },
    }).as('exportCSV');

    cy.get('button svg[data-testid="CloudDownloadIcon"]').first().click();
    cy.get('header').should('contain', 'External calls');
  });
});
