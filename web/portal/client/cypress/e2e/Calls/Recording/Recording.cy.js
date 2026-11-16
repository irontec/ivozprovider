import RecordingCollection from '../../../fixtures/Recording/getCollection.json';
import RecordingItem from '../../../fixtures/Recording/getItem.json';
import UsersCdrsCollection from '../../../fixtures/UsersCdrs/getCollection.json';

describe('Recording', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Calls-Recording');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('Call registries').click();
    cy.get('svg[data-testid="SettingsVoiceIcon"]')
      .first()
      .click({ force: true });
    cy.get('header').should('contain', 'Recordings');

    cy.get('table').should('contain', RecordingCollection.body[0].caller);
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

  it('Download multiple recording files', () => {
    const downloadDir = 'cypress/downloads';
    const fileName = 'recordings.zip';
    cy.intercept('GET', '**/api/client/recordings/recorded_files_zip?*', {}).as(
      'getDownloadRecordings'
    );

    cy.get('tbody.MuiTableBody-root > tr').each(($tr) => {
      cy.wrap($tr).find('td').first().click();
    });

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Download').click();

    cy.readFile(`${downloadDir}/${fileName}`).should('exist');

    cy.contains('Caller');
  });

  it('Export to CSV only the recordings of the call', () => {
    cy.intercept('GET', '**/api/client/recordings?*_pagination=false*', {
      statusCode: 200,
      headers: {
        'Content-Type': 'text/csv; charset=utf-8',
      },
      body: 'callid,calldate,type,duration,caller,callee,recorder,id\n',
    }).as('getRecordingsCsv');

    cy.intercept('GET', '**/api/client/users_cdrs/1', {
      statusCode: 200,
      body: UsersCdrsCollection.body[0],
    }).as('getUsersCdr-1');

    cy.contains('Call registries').click();
    cy.get('table svg[data-testid="SettingsVoiceIcon"]').first().click();
    cy.get('header').should('contain', 'Recordings');
    cy.wait('@getRecording');
    cy.get('table').should('contain', RecordingCollection.body[0].caller);

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Export to CSV').click();

    cy.wait('@getRecordingsCsv').then(({ request }) => {
      expect(request.headers.accept).to.eq('text/csv');
      expect(decodeURIComponent(request.url)).to.include('usersCdr[]=1');
    });
    cy.contains('Caller');
  });
});
