import RoutingTagCollection from '../../fixtures/Provider/RoutingTags/getCollection.json';
import RoutingTagItem from '../../fixtures/Provider/RoutingTags/getItem.json';
import newRoutingTag from '../../fixtures/Provider/RoutingTags/post.json';
import editRoutingTag from '../../fixtures/Provider/RoutingTags/put.json';

describe('in Routing Tags', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RoutingTag');
    cy.before();

    cy.get('svg[data-testid="CallSplitIcon"]').first().click();
    cy.contains('Routing Tags').click();

    cy.get('header').should('contain', 'Routing Tags');

    cy.get('table').should('contain', RoutingTagCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Routing Tag', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/routing_tags*',
        response: newRoutingTag.response,
        matchingRules: newRoutingTag.matchingRules,
      },
      'createRoutingTag'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newRoutingTag.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing Tags');

    cy.usePactWait(['createRoutingTag'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a Routing Tag', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/routing_tags/1',
        response: { ...RoutingTagItem },
      },
      'getRoutingTag-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/routing_tags/${editRoutingTag.response.body.id}`,
        response: editRoutingTag.response,
      },
      'editRoutingTag'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editRoutingTag.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Routing Tags');

    cy.usePactWait(['editRoutingTag'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Routing Tag', () => {
    cy.intercept('DELETE', '**/api/brand/routing_tags/1', {
      statusCode: 204,
    }).as('deleteRoutingTag');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Routing Tags');

    cy.usePactWait(['deleteRoutingTag'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
