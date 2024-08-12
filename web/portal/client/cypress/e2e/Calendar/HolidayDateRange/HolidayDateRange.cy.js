import HolidayDateCollection from '../../../fixtures/HolidayDate/getCollection.json';
import newHolidayDateRange from '../../../fixtures/HolidayDate/postHolidayDateRange.json';

describe('HolidayDateRange', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RoutingTools-HolidayDateRange');
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
});
