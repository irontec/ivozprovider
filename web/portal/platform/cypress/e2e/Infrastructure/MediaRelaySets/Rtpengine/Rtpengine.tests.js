import newRtpengine from '../../../../fixtures/Rtpengine/post.json';
import editRtpengine from '../../../../fixtures/Rtpengine/put.json';

export const postRtpengine = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/rtpengines*',
      response: newRtpengine.response,
      matchingRules: newRtpengine.matchingRules,
    },
    'createRtpengine'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newRtpengine.request);

  cy.get('header').should('contain', 'Media Relays');

  cy.usePactWait('createRtpengine')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putRtpengine = () => {
  cy.intercept('GET', '**/api/platform/rtpengines/1', {
    ...editRtpengine,
  }).as('getRtpengine-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/rtpengines/${editRtpengine.response.body.id}`,
      response: editRtpengine.response,
    },
    'editRtpengine'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editRtpengine.request);
  cy.get('header').should('contain', 'Media Relays');

  cy.usePactWait(['editRtpengine'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteRtpengine = () => {
  cy.intercept('DELETE', '**/api/platform/rtpengines/*', {
    statusCode: 204,
  }).as('deleteRtpengine');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Media Relays');

  cy.usePactWait(['deleteRtpengine'])
    .its('response.statusCode')
    .should('eq', 204);
};
