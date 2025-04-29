import RoutingPatternGroupCollection from '../../fixtures/Provider/RoutingPatternGroups/getCollection.json';
import RoutingPatternGroupItem from '../../fixtures/Provider/RoutingPatternGroups/getItem.json';
import newRoutingPatternGroup from '../../fixtures/Provider/RoutingPatternGroups/post.json';
import editRoutingPatternGroup from '../../fixtures/Provider/RoutingPatternGroups/put.json';

describe('in Routing Pattern Groups', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RoutingPatternGroup');
    cy.before();

    cy.get('svg[data-testid="CallSplitIcon"]').first().click();
    cy.contains('Routing pattern group').click();

    cy.get('header').should('contain', 'Routing pattern groups');

    cy.get('table').should(
      'contain',
      RoutingPatternGroupCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Routing Pattern Group', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/routing_pattern_groups*',
        response: newRoutingPatternGroup.response,
        matchingRules: newRoutingPatternGroup.matchingRules,
      },
      'createRoutingPatternGroup'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newRoutingPatternGroup.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing pattern groups');

    cy.usePactWait(['createRoutingPatternGroup'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a Routing Pattern Group', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/routing_pattern_groups/1',
        response: { ...RoutingPatternGroupItem },
      },
      'getRoutingPatternGroup-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/routing_pattern_groups/${editRoutingPatternGroup.response.body.id}`,
        response: editRoutingPatternGroup.response,
      },
      'editRoutingPatternGroup'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(1).click();

    const { ...rest } = editRoutingPatternGroup.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing pattern groups');

    cy.usePactWait(['editRoutingPatternGroup'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Routing Pattern Group', () => {
    cy.intercept('DELETE', '**/api/brand/routing_pattern_groups/1', {
      statusCode: 204,
    }).as('deleteRoutingPatternGroup');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(1).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Routing pattern groups');

    cy.usePactWait(['deleteRoutingPatternGroup'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
