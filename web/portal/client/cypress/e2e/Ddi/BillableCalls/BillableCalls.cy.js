import BillableCallItem from '../../../fixtures/BillableCall/getItem.json';
import DdiCollection from '../../../fixtures/Ddi/getCollection.json';

describe('Ddi ExternalCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ddi');
    cy.before();

    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdiCollection.body[0].ddie164);

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
});
