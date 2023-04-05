import ScheduleCollection from '../../fixtures/Schedule/getCollection.json';
import newSchedule from '../../fixtures/Schedule/post.json';
import ScheduleItem from '../../fixtures/Schedule/getItem.json';
import editSchedule from '../../fixtures/Schedule/put.json';

describe('in Schedule', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Schedule');
    cy.before();

    cy.contains('Horarios').click();

    cy.get('h3').should('contain', 'List of Horarios');

    cy.get('table').should('contain', ScheduleCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Schedule', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/schedules*',
        response: newSchedule.response,
        matchingRules: newSchedule.matchingRules,
      },
      'createSchedule'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      timeIn,
      timeout,
      monday,
      tuesday,
      wednesday,
      thursday,
      friday,
      saturday,
      sunday,
    } = newSchedule.request;
    cy.fillTheForm({
      name,
      timeIn,
      timeout,
      monday,
      tuesday,
      wednesday,
      thursday,
      friday,
      saturday,
      sunday,
    });

    cy.get('h3').should('contain', 'List of Horarios');

    cy.usePactWait('createSchedule')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Schedule', () => {
    cy.intercept('GET', '**/api/client/schedules/1', {
      ...ScheduleItem,
    }).as('getSchedule-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/schedules/${editSchedule.response.body.id}`,
        response: editSchedule.response,
      },
      'editSchedule'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      timeIn,
      timeout,
      monday,
      tuesday,
      wednesday,
      thursday,
      friday,
      saturday,
      sunday,
    } = editSchedule.request;
    cy.fillTheForm({
      name,
      timeIn,
      timeout,
      monday,
      tuesday,
      wednesday,
      thursday,
      friday,
      saturday,
      sunday,
    });

    cy.contains('List of Horarios');

    cy.usePactWait(['editSchedule'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Schedule', () => {
    cy.intercept('DELETE', '**/api/client/schedules/*', {
      statusCode: 204,
    }).as('deleteSchedule');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Horarios');

    cy.usePactWait(['deleteSchedule'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
