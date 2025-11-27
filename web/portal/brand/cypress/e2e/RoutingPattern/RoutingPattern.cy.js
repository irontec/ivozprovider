import RoutingPatternCollection from '../../fixtures/Provider/RoutingPatterns/getCollection.json';
import RoutingPatternItem from '../../fixtures/Provider/RoutingPatterns/getItem.json';
import newRoutingPattern from '../../fixtures/Provider/RoutingPatterns/post.json';
import editRoutingPattern from '../../fixtures/Provider/RoutingPatterns/put.json';

describe('in Routing Patterns', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RoutingPattern');
    cy.before();

    cy.get('svg[data-testid="CallSplitIcon"]').first().click();
    cy.contains('Routing Patterns').click();

    cy.get('header').should('contain', 'Routing Patterns');

    cy.get('table').should('contain', RoutingPatternCollection.body[0].name.en);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Routing Pattern', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/routing_patterns*',
        response: newRoutingPattern.response,
        matchingRules: newRoutingPattern.matchingRules,
      },
      'createRoutingPattern'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newRoutingPattern.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing Patterns');

    cy.usePactWait(['createRoutingPattern'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a Routing Pattern', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/routing_patterns/1',
        response: { ...RoutingPatternItem },
      },
      'getRoutingPattern-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/routing_patterns/${editRoutingPattern.response.body.id}`,
        response: editRoutingPattern.response,
      },
      'editRoutingPattern'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editRoutingPattern.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing Patterns');

    cy.usePactWait(['editRoutingPattern'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Routing Pattern', () => {
    cy.intercept('DELETE', '**/api/brand/routing_patterns/1', {
      statusCode: 204,
    }).as('deleteRoutingPattern');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Routing Patterns');

    cy.usePactWait(['deleteRoutingPattern'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
