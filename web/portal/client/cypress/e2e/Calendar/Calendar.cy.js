import CalendarCollection from '../../fixtures/Calendar/getCollection.json';
import newCalendar from '../../fixtures/Calendar/post.json';
import CalendarItem from '../../fixtures/Calendar/getItem.json';
import editCalendar from '../../fixtures/Calendar/put.json';

describe('in Calendar', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Calendar');
    cy.before();

    cy.contains('Calendarios').click();

    cy.get('h3').should('contain', 'List of Calendarios');

    cy.get('table').should('contain', CalendarCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Calendar', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/calendars*',
        response: newCalendar.response,
        matchingRules: newCalendar.matchingRules,
      },
      'createCalendar'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newCalendar.request);

    cy.get('h3').should('contain', 'List of Calendarios');

    cy.usePactWait('createCalendar')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Calendar', () => {
    cy.intercept('GET', '**/api/client/calendars/1', {
      ...CalendarItem,
    }).as('getCalendar-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/calendars/${editCalendar.response.body.id}`,
        response: editCalendar.response,
      },
      'editCalendar'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editCalendar.request);

    cy.contains('List of Calendarios');

    cy.usePactWait(['editCalendar'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Calendar', () => {
    cy.intercept('DELETE', '**/api/client/calendars/*', {
      statusCode: 204,
    }).as('deleteCalendar');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Calendarios');

    cy.usePactWait(['deleteCalendar'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
