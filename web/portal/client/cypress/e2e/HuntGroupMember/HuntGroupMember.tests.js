import HuntGroupItem from '../../fixtures/HuntGroup/getItem.json';
import newHuntGroupMembers from '../../fixtures/HuntGroupMember/post.json';
import UsersCollection from '../../fixtures/Users/getCollection.json';

export const postHuntGroupMember = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/client/hunt_group_members*',
      response: newHuntGroupMembers.response,
      matchingRules: newHuntGroupMembers.matchingRules,
    },
    'createHuntGroupMember'
  );

  cy.get('[aria-label=Add]').click();

  cy.intercept('GET', '**/api/client/hunt_groups/1*', {
    ...HuntGroupItem,
  }).as('getHountGroup-1');

  cy.intercept('GET', '**/api/client/hunt_groups/1/users_available?*', {
    ...UsersCollection,
  }).as('getHuntGroupsUsersAvailable-1');

  const { routeType, user } = newHuntGroupMembers.request;
  cy.fillTheForm({
    routeType,
    user,
  });

  cy.get('header').should('contain', 'Hunt Group members');

  cy.usePactWait('createHuntGroupMember')
    .its('response.statusCode')
    .should('eq', 201);
};

export const deleteHuntGroupMember = () => {
  cy.intercept('DELETE', '**/api/client/hunt_group_members/*', {
    statusCode: 204,
  }).as('deleteHuntGroupMember');

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
};
