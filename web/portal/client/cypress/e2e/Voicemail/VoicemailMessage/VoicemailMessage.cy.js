import VoicemailMessageCollection from '../../../fixtures/VoicemailMessage/getCollection.json';

describe('Voicemail Message', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Voicemail-VoicemailMessage');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Voicemails').click();

    cy.get('header').should('contain', 'Voicemails');

    cy.get('svg[data-testid="FormatListBulletedIcon"]').first().click();

    cy.get('table').should('contain', VoicemailMessageCollection.body[0].id);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Voicemail Message', () => {
    cy.intercept('DELETE', '**/api/client/voicemail_messages/*', {
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
