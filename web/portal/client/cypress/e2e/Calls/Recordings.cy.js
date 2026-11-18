import RecordingCollection from '../../fixtures/Recording/getCollection.json';
import RecordingItem from '../../fixtures/Recording/getItem.json';

describe('Recording', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Recording');
    cy.before();

    cy.contains('Calls').click();

    cy.contains('Recordings').click();

    cy.get('header').should('contain', 'Recordings');

    cy.get('table').should('contain', RecordingCollection.body[0].type);
  });

  it('Delete recording', () => {
    cy.intercept('DELETE', '**/api/client/recordings/*', {
      statusCode: 204,
    }).as('deleteRecording');

    cy.get('svg[data-testid="DeleteIcon"]').last().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Recordings');

    cy.usePactWait(['deleteRecording'])
      .its('response.statusCode')
      .should('eq', 204);
  });

  it('Detailed view', () => {
    cy.intercept('GET', '**/api/client/recordings/1', {
      ...RecordingItem,
    }).as('getRecording-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();
    cy.contains('Caller');
  });

  it('Export to CSV', () => {
    cy.intercept('GET', '**/api/client/recordings?_pagination=false', {
      statusCode: 200,
      headers: {
        'Content-Type': 'text/csv; charset=utf-8',
      },
      body:
        'callid,calldate,type,duration,caller,callee,recorder,id\n' +
        '7602fd7f-4153-4475-9100-d89ff70cdf76,"2017-01-05 01:15:15",ondemand,3,34946002020,34946002021,,1\n',
    }).as('getRecordingsCsv');

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Export to CSV').click();

    cy.wait('@getRecordingsCsv').then(({ request, response }) => {
      expect(request.headers.accept).to.eq('text/csv');
      expect(response.statusCode).to.eq(200);
    });
    cy.get('header').should('contain', 'Recordings');
  });
});
