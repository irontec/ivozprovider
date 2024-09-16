import FriendCollection from '../../fixtures/Friend/getCollection.json';
import FriendItem from '../../fixtures/Friend/getItem.json';
import FriendItemVpbx from '../../fixtures/Friend/getItemVpbx.json';
import editFriend from '../../fixtures/Friend/put.json';
import editFriendVpbx from '../../fixtures/Friend/putVpbx.json';

describe('Friend', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Friend');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Friends').click();

    cy.get('header').should('contain', 'Friends');

    cy.get('table').should('contain', FriendCollection.body[0].name);
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

    cy.get('header').contains('Friends');

    cy.usePactWait(['editFriend']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Friend Vpbx', () => {
    cy.intercept('GET', '**/api/client/friends/3', {
      ...FriendItemVpbx,
    }).as('getFriend-3');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/friends/${editFriendVpbx.response.body.id}`,
        response: editFriendVpbx.response,
      },
      'editFriend-3'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(1).click();
    const { description, priority } = editFriendVpbx.request;

    cy.fillTheForm({
      description,
      priority,
    });

    cy.get('header').contains('Friends');

    cy.usePactWait(['editFriend-3'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('it cannot delete Friend', () => {
    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Delete').should('have.class', 'disabled');
  });
});
