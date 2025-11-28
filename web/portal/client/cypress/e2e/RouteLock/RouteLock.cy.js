import RouteLockCollection from '../../fixtures/RouteLock/getCollection.json';
import RouteLockItem from '../../fixtures/RouteLock/getItem.json';
import newRouteLock from '../../fixtures/RouteLock/post.json';
import editRouteLock from '../../fixtures/RouteLock/put.json';

describe('RouteLock', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RouteLock');
    cy.before();

    cy.contains('Routing tools').click();
    cy.contains('Route Lock').click();

    cy.get('header').should('contain', 'Route Lock');

    cy.get('table').should('contain', RouteLockCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add RouteLock', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/route_locks*',
        response: newRouteLock.response,
        matchingRules: newRouteLock.matchingRules,
      },
      'createRouteLock'
    );

    cy.get('[aria-label=Add]').click();

    const { name, description } = newRouteLock.request;
    cy.fillTheForm({
      name,
      description,
    });

    cy.get('header').should('contain', 'Route Lock');

    cy.usePactWait('createRouteLock')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit RouteLock', () => {
    cy.intercept('GET', '**/api/client/route_locks/1', {
      ...RouteLockItem,
    }).as('getRouteLock-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/route_locks/${editRouteLock.response.body.id}`,
        response: editRouteLock.response,
      },
      'editRouteLock'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, description, open } = editRouteLock.request;
    cy.fillTheForm({
      name,
      description,
      open,
    });

    cy.contains('Route Lock');

    cy.usePactWait(['editRouteLock'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete RouteLock', () => {
    cy.intercept('DELETE', '**/api/client/route_locks/*', {
      statusCode: 204,
    }).as('deleteRouteLock');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Route Lock');

    cy.usePactWait(['deleteRouteLock'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
