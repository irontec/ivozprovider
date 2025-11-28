import FriendPatternsCollection from '../../../fixtures/FriendPattern/getCollection.json';
import FriendPatternsItem from '../../../fixtures/FriendPattern/getItem.json';
import NewFriendPatterns from '../../../fixtures/FriendPattern/post.json';
import editFriendPatternsItem from '../../../fixtures/FriendPattern/put.json';

describe('Friend Patterns', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Friends-FriendPatterns');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Friends').click();

    cy.get('header').should('contain', 'Friends');
    cy.get('svg[data-testid="FormatListNumberedIcon"]').first().click();

    cy.get('table').should('contain', FriendPatternsCollection.body[0].name);
  });

  /////////////////////
  //POST;
  /////////////////////
  it('add FriendPatterns', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/friends_patterns*',
        response: NewFriendPatterns.response,
        matchingRules: NewFriendPatterns.matchingRules,
      },
      'createFriendPatterns'
    );

    cy.get('[aria-label=Add]').click({ force: true });

    const { name, regExp } = NewFriendPatterns.request;
    cy.fillTheForm({
      name,
      regExp,
    });

    cy.get('header').should('contain', 'Friend Patterns');
    cy.usePactWait('createFriendPatterns')
      .its('response.statusCode')
      .should('eq', 201);
  });

  // ///////////////////////////////
  // // PUT
  // ///////////////////////////////
  it('edit FriendPatterns', () => {
    cy.intercept('GET', '**/api/client/friends_patterns/1', {
      ...FriendPatternsItem,
    }).as('getFriendPatterns-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/friends_patterns/${editFriendPatternsItem.response.body.id}`,
        response: editFriendPatternsItem.response,
      },
      'editFriendPatternsItem'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, regExp } = editFriendPatternsItem.request;
    cy.fillTheForm({
      regExp,
      name,
    });

    cy.contains('Friends');

    cy.usePactWait(['editFriendPatternsItem'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete FriendPatterns', () => {
    cy.intercept('DELETE', '**/api/client/friends_patterns/*', {
      statusCode: 204,
    }).as('deleteFriendPatterns');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Friends');
    cy.usePactWait(['deleteFriendPatterns'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
