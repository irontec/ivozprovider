import ConditionalRouteCollection from '../../fixtures/ConditionalRoute/getCollection.json';
import newConditionalRoute from '../../fixtures/ConditionalRoute/post.json';
import ConditionalRouteItem from '../../fixtures/ConditionalRoute/getItem.json';
import editConditionalRoute from '../../fixtures/ConditionalRoute/put.json';

describe('in ConditionalRoute', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ConditionalRoute');
    cy.before();

    cy.contains('Rutas condicionales').click();

    cy.get('h3').should('contain', 'List of Rutas condicionales');

    cy.get('table').should('contain', ConditionalRouteCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add ConditionalRoute', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/conditional_routes*',
        response: newConditionalRoute.response,
        matchingRules: newConditionalRoute.matchingRules,
      },
      'createConditionalRoute'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      locution,
      routetype,
      ivr,
      huntGroup,
      voicemail,
      user,
      numberCountry,
      numbervalue,
      friendvalue,
      queue,
      conferenceRoom,
      extension,
    } = newConditionalRoute.request;
    cy.fillTheForm({
      name,
      locution,
      routetype,
      ivr,
      huntGroup,
      voicemail,
      user,
      numberCountry,
      numbervalue,
      friendvalue,
      queue,
      conferenceRoom,
      extension,
    });

    cy.get('h3').should('contain', 'List of Rutas condicionales');

    cy.usePactWait('createConditionalRoute')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit ConditionalRoute', () => {
    cy.intercept('GET', '**/api/client/conditional_routes/1', {
      ...ConditionalRouteItem,
    }).as('getConditionalRoute-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/conditional_routes/${editConditionalRoute.response.body.id}`,
        response: editConditionalRoute.response,
      },
      'editConditionalRoute'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      locution,
      routetype,
      ivr,
      huntGroup,
      voicemail,
      user,
      numberCountry,
      numbervalue,
      friendvalue,
      queue,
      conferenceRoom,
      extension,
    } = editConditionalRoute.request;
    cy.fillTheForm({
      name,
      locution,
      routetype,
      ivr,
      huntGroup,
      voicemail,
      user,
      numberCountry,
      numbervalue,
      friendvalue,
      queue,
      conferenceRoom,
      extension,
    });

    cy.contains('List of Rutas condicionales');

    cy.usePactWait(['editConditionalRoute'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete ConditionalRoute', () => {
    cy.intercept('DELETE', '**/api/client/conditional_routes/*', {
      statusCode: 204,
    }).as('deleteConditionalRoute');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Rutas condicionales');

    cy.usePactWait(['deleteConditionalRoute'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
