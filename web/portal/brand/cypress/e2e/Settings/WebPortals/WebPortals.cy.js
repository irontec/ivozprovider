import WebPortalsCollection from '../../../fixtures/Provider/WebPortals/getCollection.json';
import {
  deleteWebPortal,
  postWebPortal,
  putWebPortal,
} from './WebPortals.tests';

describe('in WebPortals', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('WebPortals');
    cy.before();

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Administration Portals').click();

    cy.get('header').should('contain', 'Administration Portals');

    cy.get('table').should('contain', WebPortalsCollection.body[0].name);
  });

  //////////////////////
  // POST
  //////////////////////
  it('add WebPortal', postWebPortal);

  //////////////////////
  // PUT
  //////////////////////
  it('edit WebPortal', putWebPortal);

  //////////////////////
  // DELETE
  //////////////////////
  it('delete WebPortal', deleteWebPortal);
});
