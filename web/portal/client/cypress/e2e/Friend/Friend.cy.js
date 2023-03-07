import FriendCollection from '../../fixtures/Friend/getCollection.json';
import newFriend from '../../fixtures/Friend/post.json';
import FriendItem from '../../fixtures/Friend/getItem.json';
import editFriend from '../../fixtures/Friend/put.json';

describe('in Friend', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Friend');
    cy.before();

    cy.contains('Friend').click();

    cy.get('h3').should('contain', 'List of Friends');

    cy.get('table').should('contain', FriendCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Friend', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/friends*',
        response: newFriend.response,
        matchingRules: newFriend.matchingRules,
      },
      'createFriend'
    );

    cy.get('[aria-label=Add]').click();

    const {
      directConnectivity,
      priority,
      description,
      name,
      password,
      transport,
      ip,
      port,
      alwaysApplyTransformations,
    } = newFriend.request;
    cy.fillTheForm({
      directConnectivity,
      priority,
      description,
      name,
      password,
      transport,
      ip,
      port,
      alwaysApplyTransformations,
    });

    cy.get('h3').should('contain', 'List of Friends');

    cy.usePactWait('createFriend').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Friend', () => {
    cy.intercept('GET', '**/api/client/friends/1', {
      ...FriendItem,
    }).as('getFriend-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/friends/${editFriend.response.body.id}`,
        response: editFriend.response,
      },
      'editFriend'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      directConnectivity,
      priority,
      description,
      name,
      password,
      transport,
      ip,
      port,
      alwaysApplyTransformations,
      language,
      transformationRuleSet,
      callAcl,
      outgoingDdi,
      fromUser,
      fromDomain,
      allow,
      ddiIn,
      t38Passthrough,
      rtpEncryption,
    } = editFriend.request;
    cy.fillTheForm({
      directConnectivity,
      priority,
      description,
      name,
      password,
      transport,
      ip,
      port,
      alwaysApplyTransformations,
      language,
      transformationRuleSet,
      callAcl,
      outgoingDdi,
      fromUser,
      fromDomain,
      allow,
      ddiIn,
      t38Passthrough,
      rtpEncryption,
    });

    cy.contains('List of Friends');

    cy.usePactWait(['editFriend']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Friend', () => {
    cy.intercept('DELETE', '**/api/client/friends/*', {
      statusCode: 204,
    }).as('deleteFriend');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Friends');

    cy.usePactWait(['deleteFriend'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
