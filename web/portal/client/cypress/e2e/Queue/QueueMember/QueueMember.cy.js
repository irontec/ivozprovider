import QueueMemberCollection from '../../../fixtures/QueueMember/getCollection.json';
import QueueMemberItem from '../../../fixtures/QueueMember/getItem.json';
import newQueueMember from '../../../fixtures/QueueMember/post.json';
import editQueueMemberItem from '../../../fixtures/QueueMember/put.json';

describe('Queue Members', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Queues-QueueMembers');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Queues').click();

    cy.get('header').should('contain', 'Queues');

    cy.get('svg[data-testid="FormatListNumberedIcon"]').first().click();

    cy.get('table').should('contain', QueueMemberCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add QueuesMember', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/queue_members*',
        response: newQueueMember.response,
        matchingRules: newQueueMember.matchingRules,
      },
      'createQueueMember'
    );

    cy.get('[aria-label=Add]').click();

    const { penalty, user } = newQueueMember.request;
    cy.fillTheForm({
      user,
      penalty,
    });

    cy.get('header').should('contain', 'Queue Members');
    cy.usePactWait('createQueueMember')
      .its('response.statusCode')
      .should('eq', 201);
  });

  // ///////////////////////////////
  // // PUT
  // ///////////////////////////////
  it('edit QueueMember', () => {
    cy.intercept('GET', '**/api/client/queue_members/1', {
      ...QueueMemberItem,
    }).as('getQueueMember-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/queue_members/${editQueueMemberItem.response.body.id}`,
        response: editQueueMemberItem.response,
      },
      'editQueueMemberItem'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { penalty, user } = editQueueMemberItem.request;
    cy.fillTheForm({
      user,
      penalty,
    });

    cy.contains('Queues');

    cy.usePactWait(['editQueueMemberItem'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete QueueMember', () => {
    cy.intercept('DELETE', '**/api/client/queue_members/*', {
      statusCode: 204,
    }).as('deleteQueueMember');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Queues');
    cy.usePactWait(['deleteQueueMember'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
