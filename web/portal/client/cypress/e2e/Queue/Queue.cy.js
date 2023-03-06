import QueueCollection from '../../fixtures/Queue/getCollection.json';
import newQueue from '../../fixtures/Queue/post.json';
import QueueItem from '../../fixtures/Queue/getItem.json';
import editQueue from '../../fixtures/Queue/put.json';

describe('in Queue', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Queue');
    cy.before();

    cy.contains('Colas').click();

    cy.get('h3').should('contain', 'List of Colas');

    cy.get('table').should('contain', QueueCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Queue', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/queues*',
        response: newQueue.response,
        matchingRules: newQueue.matchingRules,
      },
      'createQueue'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    } = newQueue.request;
    cy.fillTheForm({
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    });

    cy.get('h3').should('contain', 'List of Colas');

    cy.usePactWait('createQueue').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Queue', () => {
    cy.intercept('GET', '**/api/client/queues/1', {
      ...QueueItem,
    }).as('getQueue-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/queues/${editQueue.response.body.id}`,
        response: editQueue.response,
      },
      'editQueue'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    } = editQueue.request;
    cy.fillTheForm({
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    });

    cy.contains('List of Colas');

    cy.usePactWait(['editQueue']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Queue', () => {
    cy.intercept('DELETE', '**/api/client/queues/*', {
      statusCode: 204,
    }).as('deleteQueue');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Colas');

    cy.usePactWait(['deleteQueue'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
