import MusicOnHoldCollection from '../../fixtures/MusicOnHold/getCollection.json';
import newMusicOnHold from '../../fixtures/MusicOnHold/post.json';
import MusicOnHoldItem from '../../fixtures/MusicOnHold/getItem.json';
import editMusicOnHold from '../../fixtures/MusicOnHold/put.json';

describe('in MusicOnHold', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('MusicOnHold');
    cy.before();

    cy.contains('Music on hold').click();

    cy.get('h3').should('contain', 'List of Music on hold');

    cy.get('table').should('contain', MusicOnHoldCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add MusicOnHold', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/music_on_holds*',
        response: newMusicOnHold.response,
        matchingRules: newMusicOnHold.matchingRules,
      },
      'createMusicOnHold'
    );

    cy.get('[aria-label=Add]').click();

    const { name } = newMusicOnHold.request;
    cy.fillTheForm({ name });

    cy.get('h3').should('contain', 'List of Music on hold');

    cy.usePactWait('createMusicOnHold')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit MusicOnHold', () => {
    cy.intercept('GET', '**/api/client/music_on_holds/1', {
      ...MusicOnHoldItem,
    }).as('getMusicOnHold-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/music_on_holds/${editMusicOnHold.response.body.id}`,
        response: editMusicOnHold.response,
      },
      'editMusicOnHold'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name } = editMusicOnHold.request;
    cy.fillTheForm({ name });

    cy.contains('List of Music on hold');

    cy.usePactWait(['editMusicOnHold'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete MusicOnHold', () => {
    cy.intercept('DELETE', '**/api/client/music_on_holds/*', {
      statusCode: 204,
    }).as('deleteMusicOnHold');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Music on hold');

    cy.usePactWait(['deleteMusicOnHold'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
