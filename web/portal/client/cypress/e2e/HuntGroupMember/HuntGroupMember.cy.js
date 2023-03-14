import HuntGroupMemberCollection from '../../fixtures/HuntGroupMember/getCollection.json';

describe('in HuntGroupMember', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('HuntGroupMember');
    cy.before();

    cy.contains('Usuarios').click();

    cy.get('h3').should('contain', 'List of Usuarios');

    cy.get('svg[data-testid="Groups3Icon"]').first().click();

    cy.get('table').should(
      'contain',
      HuntGroupMemberCollection.body[0].priority
    );
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete HuntGroupMember', () => {
    cy.intercept('DELETE', '**/api/client/hunt_group_members/*', {
      statusCode: 204,
    }).as('deleteHuntGroupMember');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Hunt Group member');

    cy.usePactWait(['deleteHuntGroupMember'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
