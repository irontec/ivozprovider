import VoicemailItem from '../../../fixtures/Voicemail/getItem.json';
import VoicemailMessageCollection from '../../../fixtures/VoicemailMessage/getCollection.json';

describe('Voicemail Message', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Voicemail-VoicemailMessage');
    cy.before();

    cy.intercept('GET', '**/api/user/voicemails/1', {
      ...VoicemailItem,
    }).as('getVoicemail-1');

    cy.get('svg[data-testid="MailIcon"]').first().click();
    cy.get('svg[data-testid="FormatListBulletedIcon"]').first().click();

    cy.get('table').should('contain', VoicemailMessageCollection.body[0].id);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Voicemail Message', () => {
    cy.intercept('DELETE', '**/api/user/voicemail_messages/2', {
      statusCode: 204,
    }).as('deleteVoicemailMessage');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Voicemails');
    cy.usePactWait(['deleteVoicemailMessage'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
