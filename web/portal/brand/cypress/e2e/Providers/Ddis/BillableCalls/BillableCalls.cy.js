import BillableCallsCollection from '../../../../fixtures/Provider/BillableCalls/getCollection.json';
import DdisCollection from '../../../../fixtures/Provider/Ddis/getCollection.json';

describe('in BillableCalls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ddis-billable_calls');

    cy.intercept('GET', '**/api/brand/ddis/1', {
      ...DdisCollection,
      body: DdisCollection.body.find((row) => row.id === 3),
    }).as('getDdis1');

    cy.before('ddis');
    cy.get(`svg[data-testid="ChatBubbleIcon"]`).eq(1).click();

    cy.get('header li.MuiBreadcrumbs-li:last').should(
      'contain',
      'External calls'
    );
  });

  it('contains Billable Calls', () => {
    cy.get('table').should('contain', BillableCallsCollection.body[0].caller);
  });
});
