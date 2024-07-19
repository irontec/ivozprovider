import CalendarCollection from '../../fixtures/Calendar/getCollection.json';
import CalendarItem from '../../fixtures/Calendar/getItem.json';
import newCalendar from '../../fixtures/Calendar/post.json';
import editCalendar from '../../fixtures/Calendar/put.json';

describe('Calendar', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Calendar');
    cy.before();

    cy.contains('Routing tools').click();
    cy.contains('Calendars').click();

    cy.get('header').should('contain', 'Calendars');

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

    cy.get('header').should('contain', 'Calendars');

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

    cy.contains('Calendars');

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

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Delete').click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Calendars');

    cy.usePactWait(['deleteCalendar'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
