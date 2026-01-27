import OutgoingRoutingItem from '../../fixtures/Provider/OutgoingRoutings/getItem.json';
import newOutgoingRouting from '../../fixtures/Provider/OutgoingRoutings/post.json';
import editOutgoingRouting from '../../fixtures/Provider/OutgoingRoutings/put.json';

describe('in OutgoingRouting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('OutgoingRouting');
    cy.before();

    cy.get('svg[data-testid="CallSplitIcon"]').first().click();
    cy.contains('Outgoing Routing').click();

    cy.get('header').should('contain', 'Outgoing Routings');

    cy.get('table').should('contain', 'Apply to all clients');
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add OutgoingRouting', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/outgoing_routings*',
        response: newOutgoingRouting.response,
        matchingRules: newOutgoingRouting.matchingRules,
      },
      'createOutgoingRouting'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newOutgoingRouting.request;

    if (rest.routingMode !== 'static') {
      delete rest.forceClid;
      delete rest.carrier;
    }

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Outgoing Routings');

    cy.usePactWait(['createOutgoingRouting'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit an OutgoingRouting', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/outgoing_routings/1',
        response: { ...OutgoingRoutingItem },
      },
      'getOutgoingRouting-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/outgoing_routings/${editOutgoingRouting.response.body.id}`,
        response: editOutgoingRouting.response,
      },
      'editOutgoingRouting'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editOutgoingRouting.request;

    if (rest.routingMode !== 'static') {
      delete rest.forceClid;
    }

    delete rest.routingMode;
    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Outgoing Routings');

    cy.usePactWait(['editOutgoingRouting'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete OutgoingRouting', () => {
    cy.intercept('DELETE', '**/api/brand/outgoing_routings/1', {
      statusCode: 204,
    }).as('deleteOutgoingRouting');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Outgoing Routings');

    cy.usePactWait(['deleteOutgoingRouting'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
