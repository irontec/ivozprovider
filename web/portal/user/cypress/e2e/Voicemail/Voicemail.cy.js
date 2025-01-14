import VoicemailCollection from '../../fixtures/Voicemail/getCollection.json';
import VoicemailItem from '../../fixtures/Voicemail/getItem.json';
import editVoicemail from '../../fixtures/Voicemail/put.json';

describe('Voicemail', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Voicemail');
    cy.before();

    cy.contains('Voicemails').click();

    cy.get('header').should('contain', 'Voicemails');

    cy.get('table').should('contain', VoicemailCollection.body[0].name);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Voicemail', () => {
    cy.intercept('GET', '**/api/user/voicemails/1', {
      ...VoicemailItem,
    }).as('getVoicemail-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/user/voicemails/${editVoicemail.response.body.id}`,
        response: editVoicemail.response,
      },
      'editVoicemail'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { enabled, sendMail, attachSound, locution } = editVoicemail.request;
    cy.fillTheForm({
      enabled,
      sendMail,
      attachSound,
      locution,
    });

    cy.contains('Voicemails');

    cy.usePactWait(['editVoicemail'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
