import HolidayDateCollection from '../../../fixtures/HolidayDate/getCollection.json';
import HolidayDateItem from '../../../fixtures/HolidayDate/getItem.json';
import newHolidayDate from '../../../fixtures/HolidayDate/post.json';
import newHolidayDateRange from '../../../fixtures/HolidayDate/postHolidayDateRange.json';
import editHolidayDate from '../../../fixtures/HolidayDate/put.json';

describe('HolidayDate', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RoutingTools-HolidayDate');
    cy.before();

    cy.contains('Routing tools').click();
    cy.contains('Calendars').click();

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Holiday dates').click();

    cy.get('table').should('contain', HolidayDateCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add HolidayDate', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/holiday_dates*',
        response: newHolidayDate.response,
        matchingRules: newHolidayDate.matchingRules,
      },
      'createHolidayDate'
    );

    cy.get('[aria-label=Add]').click();

    const { name, eventDate } = newHolidayDate.request;
    cy.fillTheForm({
      name,
      eventDate,
    });

    cy.get('header').should('contain', 'Holiday dates');
    cy.usePactWait('createHolidayDate')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit HolidayDate', () => {
    cy.intercept('GET', '**/api/client/holiday_dates/1', {
      ...HolidayDateItem,
    }).as('getHolidayDate-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/holiday_dates/${editHolidayDate.response.body.id}`,
        response: editHolidayDate.response,
      },
      'EditHolidayDate'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();
    const { name, eventDate, locution } = editHolidayDate.request;
    cy.fillTheForm({
      name,
      eventDate,
      locution,
    });
    cy.contains('Holiday dates');
    cy.usePactWait(['EditHolidayDate'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete HolidayDate', () => {
    cy.intercept('DELETE', '**/api/client/holiday_dates/*', {
      statusCode: 204,
    }).as('deleteHolidayDate');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Holiday dates');

    cy.usePactWait(['deleteHolidayDate'])
      .its('response.statusCode')
      .should('eq', 204);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add HolidayDateRange', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/holiday_dates_range*',
        response: newHolidayDateRange.response,
        matchingRules: newHolidayDateRange.matchingRules,
      },
      'createHolidayDateRange'
    );

    cy.get('button svg[data-testid="MoreHorizIcon"]').first().click();

    cy.contains('Add Holiday date range').click();

    const { startDate, endDate, locution, name } = newHolidayDateRange.request;
    cy.fillTheForm({
      startDate,
      endDate,
      locution,
      name,
    });

    cy.get('header').should('contain', 'Holiday dates');
    cy.usePactWait('createHolidayDateRange')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('import CSV', () => {
    cy.intercept('POST', '**/api/client/holiday_dates/mass_import*', {
      statusCode: 201,
      body: {
        success: true,
        errorMsg: '',
        failed: 0,
      },
      headers: {
        'Content-Type': 'application/json; charset=utf-8',
      },
    }).as('createImportCSV');

    cy.get('button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Import Holiday Dates').click();
    cy.get('h2').should('contain', 'Import Holiday Dates');

    cy.uploadFile(
      'cypress/assets/massImport.csv',
      'input[type="file"]',
      'text/csv',
      'binary'
    );

    cy.get('div').should('contain', 'massImport.csv');
    cy.contains('Continue').click();

    cy.get('p').should('contain', 'Fields with * are required.');
    cy.contains('Send').click();

    cy.get('div').should('contain', 'All lines have been imported');
    cy.contains('Close').click();

    cy.get('header').should('contain', 'Holiday dates');
  });
});
