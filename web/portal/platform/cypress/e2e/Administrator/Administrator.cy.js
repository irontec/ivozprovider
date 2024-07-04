import AdministratorCollection from '../../fixtures/Administrator/getCollection.json';
import {
  deleteAdministrator,
  postAdministrator,
  putAdministrator,
} from './Administrator.tests';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Administrator');
    cy.before();

    cy.contains('Main operators').click();

    cy.get('header').should('contain', 'Main operators');

    cy.get('table').should('contain', AdministratorCollection.body[0].username);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Administrator', postAdministrator);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Administrator', putAdministrator);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Administrator', deleteAdministrator);
});
