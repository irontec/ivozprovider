import AdministratorCollection from '../../../../fixtures/Provider/Administrator/getCollection.json';
import {
  deleteAdministrator,
  postAdministrator,
  putActiveAdministratorEmptyPassword,
  putAdministrator,
} from '../../../Administrator/Administrator.tests';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx-client-administrator');
    cy.before('vpbx');
    cy.contains('Clients').click();
    cy.contains('Virtual PBXs').click();
    cy.get('header').should('contain', 'Virtual PBXs');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Client's Administrators$/)
      .click();
    cy.get('header').should('contain', "Client's Administrators");

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

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it(
    'edit active Administrator with empty password',
    putActiveAdministratorEmptyPassword
  );

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Administrator', deleteAdministrator);
});
