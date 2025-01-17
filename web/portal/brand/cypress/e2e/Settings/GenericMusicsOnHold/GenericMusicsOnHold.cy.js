import MusicsOnHoldItem from '../../../fixtures/Provider/MusicOnHold/getItem.json';
import newMusicsOnHold from '../../../fixtures/Provider/MusicOnHold/post.json';
import editMusicsOnHold from '../../../fixtures/Provider/MusicOnHold/put.json';
import MusicsOnHoldCollection from './../../../fixtures/Provider/MusicOnHold/getCollection.json';

describe('in Generic Musics on Hold', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Generic-musics-on-hold');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Generic Musics on Hold').click();

    cy.get('header').should('contain', 'Generic Musics on Hold');

    cy.get('table').should('contain', MusicsOnHoldCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Generic Musics on Hold', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/music_on_holds*',
        response: newMusicsOnHold.response,
        matchingRules: newMusicsOnHold.matchingRules,
      },
      'createMusicsOnHold'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newMusicsOnHold.request);

    cy.get('header').should('contain', 'Generic Musics on Hold');

    cy.usePactWait(['createMusicsOnHold'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////
  // PUT
  ///////////////////
  it('edit Generic Musics on Hold', () => {
    cy.intercept('GET', '**/api/brand/music_on_holds/1', {
      ...MusicsOnHoldItem,
    }).as('getMusicsOnHold-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/music_on_holds/${editMusicsOnHold.response.body.id}`,
        response: editMusicsOnHold.response,
      },
      'editMusicsOnHold'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editMusicsOnHold.request;
    delete rest.originalFile;
    delete rest.encodedFile;

    cy.fillTheForm(rest);

    cy.usePactWait(['editMusicsOnHold'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  // DELETE
  /////////////////////
  it('delete Generic Musics on Hold', () => {
    cy.intercept('DELETE', '**/api/brand/music_on_holds/1', {
      statusCode: 204,
    }).as('deleteMusicsOnHold');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Generic Musics on Hold');

    cy.usePactWait(['deleteMusicsOnHold'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
