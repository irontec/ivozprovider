import WebPortalCollection from '../../fixtures/Provider/WebPortal/getCollection.json';
import {
  deleteteWebPortals,
  postWebPortals,
  putWebPortals,
} from './WebPortal.tests';

describe('in Web portals', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Web-portals');
    cy.before();

    cy.contains('Platform portals').click();

    cy.get('header').should('contain', 'Platform portals');

    cy.get('table').should('contain', WebPortalCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Web portals', postWebPortals);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Web portals', putWebPortals);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Web portals', deleteteWebPortals);
});
