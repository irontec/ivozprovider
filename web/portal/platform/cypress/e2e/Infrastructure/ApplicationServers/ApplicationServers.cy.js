import MediaRelaySetsCollection from '../../../fixtures/ApplicationServer/getCollection.json';
import {
  deleteApplicationServers,
  postApplicationServers,
  putApplicationServers,
} from './ApplicationServers.tests';

describe('in Application Servers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Application-servers');
    cy.before();

    cy.contains('Infrastructure').click();
    cy.contains('Application Servers').click();

    cy.get('header').should('contain', 'Application Servers');

    cy.get('table').should('contain', MediaRelaySetsCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Application Servers', postApplicationServers);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Application Servers', putApplicationServers);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Application Servers', deleteApplicationServers);
});
