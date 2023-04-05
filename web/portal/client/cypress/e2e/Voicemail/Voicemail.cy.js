import VoicemailCollection from '../../fixtures/Voicemail/getCollection.json';
import newVoicemail from '../../fixtures/Voicemail/post.json';
import VoicemailItem from '../../fixtures/Voicemail/getItem.json';
import editVoicemail from '../../fixtures/Voicemail/put.json';

describe('in Voicemail', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Voicemail');
    cy.before();

    cy.contains('Buzones de voz').click();

    cy.get('h3').should('contain', 'List of Buzones de voz');

    cy.get('table').should('contain', VoicemailCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Voicemail', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/voicemails*',
        response: newVoicemail.response,
        matchingRules: newVoicemail.matchingRules,
      },
      'createVoicemail'
    );

    cy.get('[aria-label=Add]').click();

    const { enabled, name, sendMail, email, attachSound, locution } =
      newVoicemail.request;
    cy.fillTheForm({
      enabled,
      name,
      sendMail,
      email,
      attachSound,
      locution,
    });

    cy.get('h3').should('contain', 'List of Buzones de voz');

    cy.usePactWait('createVoicemail')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Voicemail', () => {
    cy.intercept('GET', '**/api/client/voicemails/1', {
      ...VoicemailItem,
    }).as('getVoicemail-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/voicemails/${editVoicemail.response.body.id}`,
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

    cy.contains('List of Buzones de voz');

    cy.usePactWait(['editVoicemail'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
