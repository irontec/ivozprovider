import MediaRelaySetsCollection from '../../../fixtures/MediaRelaySets/getCollection.json';
import {
  deleteMediaRelaySets,
  postMediaRelaySets,
  putMediaRelaySets,
} from './MediaRelaySets.tests';

describe('in Media relay sets', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Media-relay-sets');
    cy.before();

    cy.contains('Infrastructure').click();
    cy.contains('Media Relay Sets').click();

    cy.get('header').should('contain', 'Media Relay Sets');

    cy.get('table').should('contain', MediaRelaySetsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Media Relay Sets', postMediaRelaySets);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Media Relay Sets', putMediaRelaySets);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Media Relay Sets', deleteMediaRelaySets);
});
