import FriendsCollection from '../../fixtures/Provider/Friends/getCollection.json';
import FriendItem from '../../fixtures/Provider/Friends/getItem.json';
import newFriend from '../../fixtures/Provider/Friends/post.json';
import editFriend from '../../fixtures/Provider/Friends/put.json';

describe('in Friends', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Friend');
    cy.before();

    cy.get('svg[data-testid="RoomPreferencesIcon"]').first().click();
    cy.contains('Friends').click();

    cy.get('header').should('contain', 'Friends');

    cy.get('table').should('contain', FriendsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Friend', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/friends*',
        response: newFriend.response,
        matchingRules: newFriend.matchingRules,
      },
      'createFriend'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newFriend.request;

    delete rest.allow;
    delete rest.fromDomain;
    delete rest.ddiIn;
    delete rest.t38Passthrough;

    if (rest.directConnectivity === 'intervpbx') {
      delete rest.ip;
      delete rest.port;
      delete rest.transport;
      delete rest.ruriDomain;
      delete rest.proxyUser;
      delete rest.multiContact;
      delete rest.name;
      delete rest.priority;
      delete rest.password;
    }

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Friends');

    cy.usePactWait(['createFriend'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a Friend', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/friends/1',
        response: { ...FriendItem },
      },
      'getFriend-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/friends/${editFriend.response.body.id}`,
        response: editFriend.response,
      },
      'editFriend'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(1).click();

    const { ...rest } = editFriend.request;
    delete rest.allow;
    delete rest.fromDomain;
    delete rest.ddiIn;
    delete rest.t38Passthrough;
    delete rest.maxCalls;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Friends');

    cy.usePactWait(['editFriend']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Friend', () => {
    cy.intercept('DELETE', '**/api/brand/friends/1', {
      statusCode: 204,
    }).as('deleteFriend');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(1).click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Friends');

    cy.usePactWait(['deleteFriend'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
