import ConditionalRouteCollection from '../../fixtures/ConditionalRoute/getCollection.json';
import ConditionalRouteItem from '../../fixtures/ConditionalRoute/getItem.json';
import newConditionalRoute from '../../fixtures/ConditionalRoute/post.json';
import editConditionalRoute from '../../fixtures/ConditionalRoute/put.json';

describe('ConditionalRoute', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ConditionalRoute');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Conditional Routes').click();

    cy.get('header').should('contain', 'Conditional Routes');

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

    cy.get('header').should('contain', 'Conditional Routes');

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

    cy.get('header').contains('Conditional Routes');

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

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Conditional Routes');

    cy.usePactWait(['deleteConditionalRoute'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
