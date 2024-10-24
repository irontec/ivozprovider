import UsersAddresses from '../../../../fixtures/Kam/UsersAddresses/getCollection.json';
import {
  addUserAddress,
  deleteUserAddress,
  editUserAddress,
} from '../../common/UserAddress.tests';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx-client-users-addresses');

    cy.before('');
    cy.contains('Clients').click();
    cy.contains('Virtual PBXs').click();

    cy.get('header').should('contain', 'Virtual PBXs');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(3).click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Authorized sources$/)
      .click();
    cy.get('header').should('contain', 'Authorized sources');

    cy.get('table').should('contain', UsersAddresses.body[0].description);
  });

  it('add UsersAddress', addUserAddress);

  it('edit UsersAddress', editUserAddress);

  it('delete UsersAddress', deleteUserAddress);
});
