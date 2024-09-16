import RecordingCollection from '../../fixtures/Recording/getCollection.json';
import RecordingItem from '../../fixtures/Recording/getItem.json';

describe('Recording', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs');
    cy.prepareGenericPactInterceptors('Recording');
    cy.before();

    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Recordings').click();

    cy.get('header').should('contain', 'Recordings');

    cy.get('table').should('contain', RecordingCollection.body[0].caller);
  });

  it('Delete recording', () => {
    cy.intercept('DELETE', '**/api/client/recordings/*', {
      statusCode: 204,
    }).as('deleteRecording');

    cy.get('svg[data-testid="DeleteIcon"]').last().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
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
});
