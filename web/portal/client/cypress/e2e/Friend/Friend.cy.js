import FriendCollection from '../../fixtures/Friend/getCollection.json';
import FriendItem from '../../fixtures/Friend/getItem.json';
import editFriend from '../../fixtures/Friend/put.json';

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

  ///////////////////////
  // DELETE
  ///////////////////////
  it('it cannot delete Friend', () => {
    cy.get(
      'td > div.actions-cell > span > button:has(svg[data-testid="DeleteIcon"])'
    )
      .first()
      .should('be.disabled');
  });
});
