import BillableCallsCollection from '../../fixtures/BillableCall/getCollection.json';
import BillableCallItem from '../../fixtures/BillableCall/getItem.json';

describe('BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('BillableCalls');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('External calls').click();

    cy.get('header').should('contain', 'External calls');
    cy.get('table').should('contain', BillableCallsCollection.body[0].caller);
  });

  it('Delete is disabled', () => {
    cy.get('button.Mui-disabled > [data-testid="DeleteIcon"]').should('exist');
  });

  it('Detailed view', () => {
    cy.intercept('GET', '**/api/client/billable_calls/1*', {
      ...BillableCallItem,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();
    cy.contains('Basic Information');
  });

  it('Link recordigns', () => {
    cy.get('table svg[data-testid="SettingsVoiceIcon"]').eq(0).click();

    cy.get('header').should('contain', 'Recordings');
  });
});
