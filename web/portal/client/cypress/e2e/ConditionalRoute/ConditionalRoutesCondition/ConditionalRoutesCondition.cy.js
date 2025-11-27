import ConditionalRoutesCondition from '../../../fixtures/ConditionalRoutesCondition/getCollection.json';
import ConditionalRoutesConditionItem from '../../../fixtures/ConditionalRoutesCondition/getItem.json';
import newConditionalRoutesCondition from '../../../fixtures/ConditionalRoutesCondition/post.json';
import editConditionalRoutesCondition from '../../../fixtures/ConditionalRoutesCondition/put.json';

describe('ConditionalRoutesCondition', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ConditionalRoutes-Conditions');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Conditional Routes').click();

    cy.get('header').should('contain', 'Conditional Routes');

    cy.get('svg[data-testid="FormatListNumberedIcon"]').first().click();

    cy.get('table').should('contain', ConditionalRoutesCondition.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add ConditionalRoutesCondition', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/conditional_routes_conditions*',
        response: newConditionalRoutesCondition.response,
        matchingRules: newConditionalRoutesCondition.matchingRules,
      },
      'createConditionalRoutesCondition'
    );

    cy.get('[aria-label=Add]').click();

    const {
      priority,
      routeType,
      numberValue,
      id,
      ivr,
      huntGroup,
      voicemail,
      user,
      queue,
      locution,
      conferenceRoom,
      extension,
      numberCountry,
      matchListIds,
      scheduleIds,
      calendarIds,
      routeLockIds,
    } = newConditionalRoutesCondition.request;
    cy.fillTheForm({
      priority,
      routeType,
      numberValue,
      id,
      ivr,
      huntGroup,
      voicemail,
      user,
      queue,
      locution,
      conferenceRoom,
      extension,
      numberCountry,
      matchListIds,
      scheduleIds,
      calendarIds,
      routeLockIds,
    });

    cy.get('header').should('contain', 'Conditional Routes');
    cy.usePactWait('createConditionalRoutesCondition')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit ConditionalRoutesCondition', () => {
    cy.intercept('GET', '**/api/client/conditional_routes_conditions/1', {
      ...ConditionalRoutesConditionItem,
    }).as('getConditionalRoutesCondition-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/conditional_routes_conditions/${editConditionalRoutesCondition.response.body.id}`,
        response: editConditionalRoutesCondition.response,
      },
      'editConditionalRoutesCondition'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      priority,
      routeType,
      numberValue,
      id,
      ivr,
      huntGroup,
      voicemail,
      user,
      queue,
      locution,
      conferenceRoom,
      extension,
      numberCountry,
      matchListIds,
      scheduleIds,
      calendarIds,
      routeLockIds,
    } = newConditionalRoutesCondition.request;
    cy.fillTheForm({
      priority,
      routeType,
      numberValue,
      id,
      ivr,
      huntGroup,
      voicemail,
      user,
      queue,
      locution,
      conferenceRoom,
      extension,
      numberCountry,
      matchListIds,
      scheduleIds,
      calendarIds,
      routeLockIds,
    });

    cy.contains('Conditional Routes');

    cy.usePactWait(['editConditionalRoutesCondition'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete ConditionalRoutesCondition', () => {
    cy.intercept('DELETE', '**/api/client/conditional_routes_conditions/*', {
      statusCode: 204,
    }).as('deleteConditionalRoutesCondition');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Conditional Routes');

    cy.usePactWait(['deleteConditionalRoutesCondition'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
