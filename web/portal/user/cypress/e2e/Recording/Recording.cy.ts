import RecordingCollection from '../../fixtures/Recording/getCollection.json';
import RecordingItem from '../../fixtures/Recording/getItem.json';

describe('CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-Recording');
    cy.before();

    cy.get('svg[data-testid="SettingsVoiceIcon"]').first().click();

    cy.get('table').should('contain', RecordingCollection.body[0].duration);
  });

  it('View CallForwardSetting', () => {
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
        url: '**api/user/recordings/2/recordedfile',
        response: '',
      },
      'getRecordedFile-2'
    );

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(`getRecording-${recordingId}`)
      .its('response.statusCode')
      .should('eq', 200);

    cy.get('input[name=callee]');
  });

  it('delete CallForwardSetting', () => {
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
});
