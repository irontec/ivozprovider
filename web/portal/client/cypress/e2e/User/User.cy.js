import UserCollection from '../../fixtures/Users/getCollection.json';
import UserItem from '../../fixtures/Users/getItem.json';
import newUser from '../../fixtures/Users/post.json';
import editUser from '../../fixtures/Users/put.json';

describe('User', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User');
    cy.before();

    cy.contains('Users').click();

    cy.get('header').should('contain', 'Users');

    cy.get('table').should('contain', UserCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add User', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/users*',
        response: newUser.response,
        matchingRules: newUser.matchingRules,
      },
      'createUser'
    );

    cy.get('[aria-label=Add]').click();

    const { name, lastname, email, extension, outgoingDdi, outgoingDdiRule } =
      newUser.request;

    cy.fillTheForm({
      name,
      lastname,
      email,
      extension,
      outgoingDdi,
      outgoingDdiRule,
    });

    cy.get('header').should('contain', 'Users');

    cy.usePactWait('createUser').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit User', () => {
    cy.intercept('GET', '**/api/client/users/1', {
      ...UserItem,
    }).as('getUser-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/users/${editUser.response.body.id}`,
        response: editUser.response,
      },
      'editUser'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      lastname,
      email,
      language,
      transformationRuleSet,
      location,
      active,
      pass,
      gsQRCode,
      isBoss,
      bossAssistant,
      bossAssistantWhiteList,
      extension,
      outgoingDdi,
      outgoingDdiRule,
      callAcl,
      doNotDisturb,
      maxCalls,
      externalIpCalls,
      multiContact,
      rejectCallMethod,
    } = editUser.request;
    cy.fillTheForm({
      name,
      lastname,
      email,
      language,
      transformationRuleSet,
      location,
      active,
      pass,
      gsQRCode,
      isBoss,
      bossAssistant,
      bossAssistantWhiteList,
      extension,
      outgoingDdi,
      outgoingDdiRule,
      callAcl,
      doNotDisturb,
      maxCalls,
      externalIpCalls,
      multiContact,
      rejectCallMethod,
    });

    cy.contains('Users');

    cy.usePactWait(['editUser']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete User', () => {
    cy.intercept('DELETE', '**/api/client/users/*', {
      statusCode: 204,
    }).as('deleteUser');

    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Delete').click();

    cy.contains('Remove element');

    cy.get('div[role=dialog] button')
      .should('be.visible')
      .contains('Yes, delete it')
      .click({ force: true });

    cy.get('header').should('contain', 'Users');

    cy.usePactWait(['deleteUser']).its('response.statusCode').should('eq', 204);
  });
});
