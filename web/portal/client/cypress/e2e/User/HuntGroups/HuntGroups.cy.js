import UserCollection from '../../../fixtures/Users/getCollection.json';

describe('HuntGroup', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-HuntGroup');
    cy.before();

    cy.contains('Users').click();

    cy.get('header').should('contain', 'Users');

    cy.get('table').should('contain', UserCollection.body[0].name);

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Hunt Group members').click();

    cy.usePactWait(['getHuntGroupMemberByUser'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete HuntGroupMember', () => {
    cy.intercept('DELETE', '**/api/client/hunt_group_members/1', {
      statusCode: 204,
    }).as('deleteHuntGroupMember');

    cy.get('header').should('contain', 'Hunt Group members');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Hunt Group members');

    cy.usePactWait(['deleteHuntGroupMember'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
