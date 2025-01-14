import UsersAddresses from '../../../../fixtures/Kam/UsersAddresses/getCollection.json';
import {
  addUserAddress,
  deleteUserAddress,
} from '../../common/UserAddress.tests';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('residential-client-users-addresses');

    cy.before('');
    cy.contains('Clients').click();
    cy.contains('Residentials').click();

    cy.get('header').should('contain', 'Residentials');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(3).click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Authorized sources$/)
      .click();
    cy.get('header').should('contain', 'Authorized sources');

    cy.get('table').should('contain', UsersAddresses.body[0].description);
  });

  it('add UserAddress', addUserAddress);

  it('delete UserAddress', deleteUserAddress);
});
