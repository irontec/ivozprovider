import newMediaRelaySets from '../../../fixtures/MediaRelaySets/post.json';
import editMediaRelaySets from '../../../fixtures/MediaRelaySets/put.json';

export const postMediaRelaySets = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/media_relay_sets*',
      response: newMediaRelaySets.response,
      matchingRules: newMediaRelaySets.matchingRules,
    },
    'createMediaRelaySets'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newMediaRelaySets.request);

  cy.get('header').should('contain', 'Media Relay Sets');

  cy.usePactWait('createMediaRelaySets')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putMediaRelaySets = () => {
  cy.intercept('GET', '**/api/platform/media_relay_sets/1', {
    ...editMediaRelaySets,
  }).as('getMediaRelaySets-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/media_relay_sets/${editMediaRelaySets.response.body.id}`,
      response: editMediaRelaySets.response,
    },
    'editMediaRelaySets'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(1).first().click();

  cy.fillTheForm(editMediaRelaySets.request);
  cy.get('header').should('contain', 'Media Relay Sets');

  cy.usePactWait(['editMediaRelaySets'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteMediaRelaySets = () => {
  cy.intercept('DELETE', '**/api/platform/media_relay_sets/*', {
    statusCode: 204,
  }).as('deleteMediaRelaySets');

  cy.get('td button > svg[data-testid="DeleteIcon"]').eq(1).first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Media Relay Sets');

  cy.usePactWait(['deleteMediaRelaySets'])
    .its('response.statusCode')
    .should('eq', 204);
};
