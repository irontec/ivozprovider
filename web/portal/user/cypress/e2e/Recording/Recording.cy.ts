import RecordingCollection from '../../fixtures/Recording/getCollection.json';
import RecordingItem from '../../fixtures/Recording/getItem.json';

describe('Recording', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-Recording');
    cy.before();

    cy.get('svg[data-testid="RecordVoiceOverIcon"]').first().click();

    cy.get('table').should('contain', RecordingCollection.body[0].duration);
  });

  it('View Recording', () => {
    const recordingId = RecordingItem.body.id;
    cy.usePactIntercept(
      {
        method: 'GET',
        url: `**api/user/recordings/${recordingId}`,
        response: RecordingItem.body,
      },
      `getRecording-${recordingId}`
    );

    cy.usePactIntercept(
      {
        method: 'GET',
        url: `**api/user/recordings/${recordingId}/recordedfile`,
        response: '',
      },
      `getRecordedFile-${recordingId}`
    );

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(`getRecording-${recordingId}`)
      .its('response.statusCode')
      .should('eq', 200);

    cy.get('input[name=callee]');
  });

  it('Delete Recording', () => {
    cy.intercept('DELETE', '**api/user/recordings/*', {
      statusCode: 204,
    }).as('deleteRecording');

    cy.get('table svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click({ force: true });

    cy.usePactWait('deleteRecording')
      .its('response.statusCode')
      .should('eq', 204);
  });

  it('Download multiple recording files', () => {
    const downloadDir = 'cypress/downloads';
    const fileName = 'recordings.zip';
    cy.intercept('GET', '**/api/user/recordings/recorded_files_zip?*', {}).as(
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
});
