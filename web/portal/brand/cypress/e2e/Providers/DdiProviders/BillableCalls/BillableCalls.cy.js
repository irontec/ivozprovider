import BillableCallItem from '../../../../fixtures/Provider/BillableCalls/getItem.json';
import DdiCollection from '../../../../fixtures/Provider/Ddis/getCollection.json';

describe('in BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ddis-billable_calls');
    cy.before('');
    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDIs').click();
    cy.get('header').should('contain', 'DDIs');
    cy.get('table').should('contain', DdiCollection.body[0].ddie164);
  });

  it('View details', () => {
    cy.intercept('GET', '**/api/brand/billable_calls/1*', {
      ...BillableCallItem,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="ChatBubbleIcon"]').first().click();
    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-1'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
